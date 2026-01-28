<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{personal.name}} - CV</title>

    <style>
        .page {
            width: 100%;
            padding: 20px;
        }

        h1 {
            font-size: 22px;
            margin: 0;
        }

        h2 {
            font-size: 14px;
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
            margin-top: 20px;
        }

        p {
            margin: 5px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .contact {
            font-size: 11px;
        }

        .section {
            margin-top: 15px;
        }

        .item {
            margin-bottom: 10px;
        }

        .small {
            font-size: 11px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 4px 0;
        }

        .skills span {
            display: inline-block;
            border: 1px solid #000;
            padding: 2px 6px;
            margin: 2px;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <h1>{{personal.name}}</h1>
            <p><strong>{{personal.role}}</strong></p>
            <p class="contact">
                {{personal.email}} | {{personal.phone}} | {{personal.location}}
            </p>
        </div>

        <!-- SUMMARY -->
        <div class="section">
            <h2>Profile Summary</h2>
            <p>{{personal.summary}}</p>
        </div>

        <!-- EXPERIENCE -->
        {{experience.loop}}
        <div class="section">
            <h2>Work Experience</h2>
            <div class="item">
                <strong>{{experience.position}}</strong><br>
                <span class="small">{{experience.company}} | {{experience.duration}}</span>
                <p>{{experience.description}}</p>
            </div>
        </div>
        {{experience.endloop}}

        <!-- PROJECTS -->
        {{projects.loop}}
        <div class="section">
            <h2>Projects</h2>
            <div class="item">
                <strong>{{projects.title}}</strong>
                <p>{{projects.description}}</p>
                <p class="small">Tech: {{projects.tech}}</p>
            </div>
        </div>
        {{projects.endloop}}

        <!-- EDUCATION -->
        {{education.loop}}
        <div class="section">
            <h2>Education</h2>
            <div class="item">
                <strong>{{education.degree}}</strong><br>
                <span class="small">{{education.institute}} ({{education.year}})</span>
            </div>
        </div>
        {{education.endloop}}

        <!-- SKILLS -->
        <div class="section">
            <h2>Skills</h2>
            <div class="skills">
                {{skills.loop}}
                <span>{{skills.name}}</span>
                {{skills.endloop}}
            </div>
        </div>

        <!-- LANGUAGES -->
        <div class="section">
            <h2>Languages</h2>
            {{languages.loop}}
            <p>{{languages.name}} - {{languages.level}}</p>
            {{languages.endloop}}
        </div>

        <!-- AWARDS -->
        {{awards.loop}}
        <div class="section">
            <h2>Awards</h2>
            <p>{{awards.title}}</p>
        </div>
        {{awards.endloop}}

        <!-- COURSES -->
        {{courses.loop}}
        <div class="section">
            <h2>Courses & Certifications</h2>
            <p>{{courses.name}}</p>
        </div>
        {{courses.endloop}}

        <!-- SOCIAL -->
        <div class="section">
            <h2>Social Links</h2>
            {{social.loop}}
            <p>{{social.platform}} : {{social.url}}</p>
            {{social.endloop}}
        </div>

    </div>
</body>

</html>