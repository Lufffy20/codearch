<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{personal.name}} - CV</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .cv-wrapper {
            max-width: 900px;
            margin: auto;
            padding: 40px;
        }

        .cv-header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .cv-name {
            font-size: 34px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .cv-role {
            font-size: 18px;
            color: #6c757d;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 6px;
            margin-bottom: 20px;
        }

        .text-muted-small {
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="cv-wrapper">

        <!-- HEADER -->
        <div class="cv-header text-center">
            <div class="cv-name">{{personal.name}}</div>
            <div class="cv-role mb-3">{{personal.role}}</div>

            <div class="d-flex justify-content-center flex-wrap gap-4 text-muted-small">
                <span>✉ {{personal.email}}</span>
                <span>☏ {{personal.phone}}</span>
                <span>📍 {{personal.location}}</span>
            </div>
        </div>

        <!-- SUMMARY -->
        <!-- <div class="mb-4">
            <div class="section-title">Professional Summary</div>
            <p class="mb-0">{{personal.summary}}</p>
        </div> -->

        <!-- EXPERIENCE -->
        <div class="mb-4">
            <div class="section-title">Experience</div>

            {{experience.loop}}
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{experience.position}}</strong>
                    <span class="text-muted-small">{{experience.duration}}</span>
                </div>
                <div class="fst-italic text-muted-small">{{experience.company}}</div>
                <p class="mb-1">{{experience.description}}</p>
            </div>
            {{experience.endloop}}
        </div>

        <!-- EDUCATION -->
        <div class="mb-4">
            <div class="section-title">Education</div>

            {{education.loop}}
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{education.degree}}</strong>
                    <span class="text-muted-small">{{education.year}}</span>
                </div>
                <div class="fst-italic text-muted-small">{{education.institute}}</div>
            </div>
            {{education.endloop}}
        </div>

        <!-- SKILLS -->
        <div class="mb-4">
            <div class="section-title">Skills</div>
            <div class="d-flex flex-wrap gap-2">
                {{skills.loop}}
                <span class="badge-skill">{{skills.name}}</span>
                {{skills.endloop}}
            </div>
        </div>

        <!-- SOCIAL LINKS -->
        <div>
            <div class="section-title">Social Profiles</div>
            <div class="d-flex flex-column gap-1">
                {{social.loop}}
                <a href="{{social.url}}" target="_blank" class="text-decoration-none text-muted-small">
                    {{social.platform}}
                </a>
                {{social.endloop}}
            </div>
        </div>

    </div>

</body>

</html>