<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{personal.name}} - CV</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">

        <!-- HEADER -->
        <div class="text-center border-bottom pb-4 mb-5">
            <h1 class="fw-bold">{{personal.name}}</h1>
            <h4 class="text-secondary mb-3">{{personal.role}}</h4>

            <div class="d-flex justify-content-center flex-wrap gap-4 text-muted">
                <span>Email: {{personal.email}}</span>
                <span>Phone: {{personal.phone}}</span>
                <span>Location: {{personal.location}}</span>
            </div>
        </div>

        <!-- SUMMARY -->
        <!-- <div class="mb-4">
            <h5 class="border-bottom pb-2 mb-3 fw-bold">Summary</h5>
            <p>{{personal.summary}}</p>
        </div> -->

        <!-- EXPERIENCE -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2 mb-3 fw-bold">Experience</h5>

            {{experience.loop}}
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{experience.position}}</strong>
                    <span class="text-muted">{{experience.duration}}</span>
                </div>
                <div class="fst-italic text-secondary">{{experience.company}}</div>
                <p class="mb-0">{{experience.description}}</p>
            </div>
            {{experience.endloop}}
        </div>

        <!-- EDUCATION -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2 mb-3 fw-bold">Education</h5>

            {{education.loop}}
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{education.degree}}</strong>
                    <span class="text-muted">{{education.year}}</span>
                </div>
                <div class="fst-italic text-secondary">{{education.institute}}</div>
            </div>
            {{education.endloop}}
        </div>

        <!-- SKILLS -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2 mb-3 fw-bold">Skills</h5>

            <div class="d-flex flex-wrap gap-2">
                {{skills.loop}}
                <span class="">
                    {{skills.name}}
                </span>
                {{skills.endloop}}

            </div>
        </div>

        <!-- SOCIAL LINKS -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2 mb-3 fw-bold">Social Links</h5>

            {{social.loop}}
            <div>
                <a href="{{social.url}}" target="_blank" class="text-decoration-none">
                    {{social.platform}}
                </a>
            </div>
            {{social.endloop}}
        </div>

    </div>

</body>

</html>