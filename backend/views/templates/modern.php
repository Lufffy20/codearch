<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{personal.name}} - CV</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <!-- CARD -->
                <div class="card shadow-sm border-0">

                    <!-- HEADER -->
                    <!-- HEADER -->
                    <div class="card-body text-center text-white"
                        style="background: linear-gradient(135deg, #667eea, #764ba2);">

                        <!-- PROFILE IMAGE -->
                        <img src="{{image.profile}}"
                            alt="Profile Photo"
                            style="width:120px;height:120px;object-fit:cover;border-radius:50%;
                border:3px solid rgba(255,255,255,0.6);margin-bottom:15px;"
                            onerror="this.style.display='none'">

                        <h1 class="fw-bold mb-1">{{personal.name}}</h1>
                        <h5 class="fw-normal mb-4">{{personal.role}}</h5>

                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-25 rounded py-2">
                                    📧 {{personal.email}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-25 rounded py-2">
                                    📞 {{personal.phone}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-white bg-opacity-25 rounded py-2">
                                    📍 {{personal.location}}
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- CONTENT -->
                    <div class="card-body p-4">

                        <!-- SUMMARY -->
                        <div class="mb-4">
                            <h5 class="fw-semibold border-bottom pb-2 mb-3">
                                Professional Summary
                            </h5>
                            <p class="mb-0">{{personal.summary}}</p>
                        </div>

                        <!-- EXPERIENCE -->
                        <div class="mb-4">
                            <h5 class="fw-semibold border-bottom pb-2 mb-3">
                                Work Experience
                            </h5>

                            {{experience.loop}}
                            <div class="border-start border-3 ps-3 mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{experience.position}}</strong>
                                    <span class="text-muted small">{{experience.duration}}</span>
                                </div>
                                <div class="fst-italic text-muted small">
                                    {{experience.company}}
                                </div>
                                <p class="mb-1">{{experience.description}}</p>
                            </div>
                            {{experience.endloop}}
                        </div>

                        <!-- EDUCATION -->
                        <div class="mb-4">
                            <h5 class="fw-semibold border-bottom pb-2 mb-3">
                                Education
                            </h5>

                            {{education.loop}}
                            <div class="border-start border-3 ps-3 mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{education.degree}}</strong>
                                    <span class="text-muted small">{{education.year}}</span>
                                </div>
                                <div class="fst-italic text-muted small">
                                    {{education.institute}}
                                </div>
                            </div>
                            {{education.endloop}}
                        </div>

                        <!-- SKILLS -->
                        <div class="mb-4">
                            <h5 class="fw-semibold border-bottom pb-2 mb-3">
                                Skills
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                {{skills.loop}}
                                <span class="badge rounded-pill text-bg-primary px-3 py-2">
                                    {{skills.name}}
                                </span>
                                {{skills.endloop}}
                            </div>
                        </div>

                        <!-- SOCIAL -->
                        <div>
                            <h5 class="fw-semibold border-bottom pb-2 mb-3">
                                Connect With Me
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                {{social.loop}}
                                <a href="{{social.url}}"
                                    class="btn btn-outline-success btn-sm rounded-pill"
                                    target="_blank">
                                    {{social.platform}}
                                </a>
                                {{social.endloop}}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>