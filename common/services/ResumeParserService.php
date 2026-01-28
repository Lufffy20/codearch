<?php

namespace common\services;

use yii\web\UploadedFile;
use Smalot\PdfParser\Parser as PdfParser;

class ResumeParserService
{
    /**
     * Parse uploaded resume file and extract text content
     */
    public static function parseResume(UploadedFile $file)
    {
        $extension = strtolower($file->getExtension());

        switch ($extension) {
            case 'pdf':
                return self::parsePdf($file->tempName);
            case 'docx':
                return self::parseDocx($file->tempName);
            case 'doc':
                return self::parseDoc($file->tempName);
            case 'txt':
                return file_get_contents($file->tempName);
            default:
                throw new \Exception('Unsupported file format. Please upload PDF, DOC, DOCX, or TXT files.');
        }
    }

    /**
     * Parse PDF file and extract text
     */
    private static function parsePdf($filePath)
    {
        // On Windows, we'll try different approaches
        if (DIRECTORY_SEPARATOR === '\\') {
            // For Windows, we'll use a pure PHP solution or check for available tools
            return self::parsePdfWindows($filePath);
        } else {
            // For Unix-like systems, try command-line tools
            return self::parsePdfUnix($filePath);
        }
    }

    /**
     * Parse PDF on Unix-like systems
     */
    private static function parsePdfUnix($filePath)
    {
        // Check if pdftotext is available (requires poppler-utils)
        $command = 'pdftotext ' . escapeshellarg($filePath) . ' - 2>/dev/null';
        $output = shell_exec($command);

        if ($output !== null) {
            return trim($output);
        }

        throw new \Exception('PDF parsing requires poppler-utils (pdftotext). Please install poppler-utils or upload a different format.');
    }

    /**
     * Parse PDF on Windows systems
     */
    private static function parsePdfWindows($filePath)
    {
        // For Windows, we'll use the installed smalot/pdfparser library
        try {
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($filePath);
            return $pdf->getText();
        } catch (\Exception $e) {
            throw new \Exception('Could not parse PDF file: ' . $e->getMessage());
        }
    }

    /**
     * Parse DOCX file and extract text
     */
    private static function parseDocx($filePath)
    {
        // Simple approach using ZipArchive to extract content from DOCX
        $zip = new \ZipArchive();
        if ($zip->open($filePath) === TRUE) {
            $content = $zip->getFromName('word/document.xml');
            $zip->close();

            if ($content !== false) {
                // Remove XML tags and clean up text
                $content = strip_tags($content);
                // Decode XML entities
                $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

                return $content;
            }
        }

        throw new \Exception('Could not parse DOCX file.');
    }

    /**
     * Parse DOC file and extract text
     */
    private static function parseDoc($filePath)
    {
        // For older DOC files on Windows, we'll use a different approach
        if (DIRECTORY_SEPARATOR === '\\') {
            // On Windows, try to use a COM object if available (Microsoft Word)
            if (class_exists('COM')) {
                try {
                    $word = new \COM("Word.Application");
                    $word->Visible = 0;
                    $doc = $word->Documents->Open($filePath);
                    $text = $doc->Content->Text;
                    $doc->Close(false);
                    $word->Quit();
                    return $text;
                } catch (\Exception $e) {
                    // If Word COM is not available, fall back to file reading
                    // Try to read as binary and convert
                    $content = file_get_contents($filePath);
                    if ($content !== false) {
                        // Basic attempt to extract readable text from binary DOC
                        $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', ' ', $content);
                        return $text;
                    }
                }
            } else {
                // If COM is not available, try to read as binary and convert
                $content = file_get_contents($filePath);
                if ($content !== false) {
                    // Basic attempt to extract readable text from binary DOC
                    $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', ' ', $content);
                    return $text;
                }
            }
        } else {
            // For Unix-like systems, try command-line tools
            // For older DOC files, we'll try to use antiword if available
            $command = 'antiword ' . escapeshellarg($filePath) . ' 2>/dev/null';
            $output = shell_exec($command);

            if ($output !== null) {
                return trim($output);
            }

            // Alternative: try catdoc
            $command = 'catdoc ' . escapeshellarg($filePath) . ' 2>/dev/null';
            $output = shell_exec($command);

            if ($output !== null) {
                return trim($output);
            }
        }

        throw new \Exception('DOC parsing requires external tools. On Windows, ensure Microsoft Word is installed. On Linux, install antiword or catdoc.');
    }

    /**
     * Extract structured data from resume text
     */
    public static function extractResumeData($resumeText)
    {
        $data = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'location' => '',
            'summary' => '',
            'education' => [],
            'experience' => [],
            'skills' => []
        ];

        // Normalize the text
        $text = preg_replace('/\s+/', ' ', $resumeText);

        // Extract email
        if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches)) {
            $data['email'] = $matches[0];
        }

        // Extract phone numbers (simple patterns)
        if (preg_match('/(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}/', $text, $matches)) {
            $data['phone'] = $matches[0];
        } elseif (preg_match('/(\+?\d{1,3}[-.\s]?)?\d{10}/', $text, $matches)) {
            $data['phone'] = $matches[0];
        }

        // Extract name (usually the first line or prominent text)
        $lines = explode("\n", $resumeText);
        foreach ($lines as $line) {
            $line = trim($line);
            if (strlen($line) > 2 && strlen($line) < 100 && !filter_var($line, FILTER_VALIDATE_EMAIL) && !is_numeric(str_replace(['+', '-', '(', ')', '.', ' ', '-'], '', $line))) {
                // Check if it looks like a name (contains letters and is capitalized)
                if (preg_match('/^[A-Z][a-z]+\s+[A-Z][a-z]+/', $line) || preg_match('/^[A-Z][a-z]+\s+[A-Z]\.?\s*[A-Z][a-z]+/', $line)) {
                    $data['name'] = $line;
                    break;
                }
            }
        }

        // If name wasn't found in the first approach, try to find it near contact info
        if (empty($data['name'])) {
            $contactPattern = '/(.*)\s+' . preg_quote($data['email'] ?: $data['phone'], '/') . '/i';
            if (preg_match($contactPattern, $text, $matches)) {
                $potentialName = trim($matches[1]);
                if (preg_match('/^[A-Z][a-z]+\s+[A-Z][a-z]+/', $potentialName)) {
                    $data['name'] = $potentialName;
                }
            }
        }

        // Extract location (look for common location indicators)
        $locationPatterns = [
            '/(?:Address|Location|City|State):\s*(.*?)(?:\n|$)/i',
            '/([A-Z][a-z]+,\s*[A-Z][a-z]+|\w+,\s*\w+,\s*\w+|\w+\s+\w+,\s*[A-Z]{2})/',
        ];

        foreach ($locationPatterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                $data['location'] = trim($matches[1]);
                break;
            }
        }

        // Extract education (look for common education keywords)
        $educationSections = self::findSection($text, ['education', 'academic', 'school', 'university', 'college']);
        foreach ($educationSections as $section) {
            $eduMatches = [];
            preg_match_all('/(Bachelor|Master|PhD|B\.Sc|M\.Sc|B\.A|M\.A|Degree|Diploma).*?(?:\n|$)/i', $section, $eduMatches);
            foreach ($eduMatches[0] as $match) {
                $data['education'][] = trim($match);
            }
        }

        // Extract experience (look for work experience section)
        $experienceSections = self::findSection($text, ['experience', 'work', 'employment', 'professional experience', 'career']);
        foreach ($experienceSections as $section) {
            // Look for company names and positions
            $expLines = explode("\n", $section);
            foreach ($expLines as $line) {
                $line = trim($line);
                if (!empty($line) && strlen($line) > 10) { // Skip short header lines
                    // Look for patterns like "Company Name - Position" or "Position at Company"
                    if (preg_match('/(.+?)\s*[-–—]\s*(.+)/', $line, $matches)) {
                        $data['experience'][] = trim($matches[2]); // Usually position is second part
                    } elseif (preg_match('/(.+?)\s+at\s+(.+)/i', $line, $matches)) {
                        $data['experience'][] = trim($matches[1]); // Position is first part
                    } else {
                        // Just add the line if it looks like a position title
                        if (preg_match('/^(Senior|Junior|Lead|Manager|Developer|Engineer|Analyst|Director|VP|CEO|CTO|CFO|COO|President|Founder|Consultant|Designer|Programmer|Administrator|Coordinator|Specialist|Supervisor|Associate|Intern|Executive)/i', $line)) {
                            $data['experience'][] = $line;
                        }
                    }
                }
            }
        }

        // Extract skills (look for skills section)
        $skillsSections = self::findSection($text, ['skills', 'technologies', 'competencies', 'expertise']);
        foreach ($skillsSections as $section) {
            // Split by commas or newlines to get individual skills
            $skills = preg_split('/[,;\n]/', $section);
            foreach ($skills as $skill) {
                $cleanSkill = trim(preg_replace('/[^\w\s\-]/', '', $skill));
                if (strlen($cleanSkill) > 2 && !in_array(strtolower($cleanSkill), ['skills', 'technologies', 'competencies'])) {
                    $data['skills'][] = $cleanSkill;
                }
            }
        }

        // Remove duplicates
        $data['skills'] = array_unique($data['skills']);
        $data['experience'] = array_unique($data['experience']);

        return $data;
    }

    /**
     * Find sections in resume text based on keywords
     */
    private static function findSection($text, $keywords)
    {
        $sections = [];
        $lines = explode("\n", $text);
        $currentSection = '';
        $inSection = false;

        foreach ($lines as $line) {
            $lineLower = strtolower($line);
            $isHeader = false;

            foreach ($keywords as $keyword) {
                if (strpos($lineLower, $keyword) !== false && strlen($line) < 50) {
                    if ($inSection) {
                        $sections[] = $currentSection;
                    }
                    $currentSection = '';
                    $inSection = true;
                    $isHeader = true;
                    break;
                }
            }

            if (!$isHeader && $inSection) {
                // Check if we've moved to a new section
                $isNextSection = false;
                foreach (['experience', 'work', 'employment', 'education', 'skills', 'summary', 'objective'] as $nextKeyword) {
                    if (strpos($lineLower, $nextKeyword) !== false && strlen($line) < 50) {
                        $isNextSection = true;
                        break;
                    }
                }

                if ($isNextSection) {
                    $sections[] = $currentSection;
                    $currentSection = '';
                    $inSection = false;
                } else {
                    $currentSection .= "\n" . $line;
                }
            }
        }

        if ($inSection && !empty($currentSection)) {
            $sections[] = $currentSection;
        }

        return $sections;
    }
}
