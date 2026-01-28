<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{personal.name}} - CV</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .cv-wrapper {
            width: 100%;
            padding: 25px;
        }

        .cv-header {
            text-align: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .cv-name {
            font-size: 22px;
            font-weight: bold;
        }

        .cv-role {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .contact {
            font-size: 11px;
            color: #666;
        }

        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 4px;
        }

        .item {
            margin-bottom: 10px;
        }

        .muted {
            color: #777;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 2px 0;
        }

        .skill {
            display: inline-block;
            border: 1px solid #333;
            padding: 2px 6px;
            margin: 2px;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="cv-wrapper">

        <!-- HEADER -->
        <div class="cv-header">

            <img src="{{image.profile}}"
                style="width:90px;height:90px;border-radius:50%;margin-bottom:10px;"
                onerror="this.style.display='none'">

            <div class="cv-name">{{personal.name}}</div>
            <div class="cv-role">{{personal.role}}</div>

            <div class="contact">
                {{personal.email}} |
                {{personal.phone}} |
                {{personal.location}}
            </div>
        </div>

        <!-- EXPERIENCE -->
        <div class="section">
            <div class="section-title">Experience</div>

            {{experience.loop}}
            <div class="item">
                <table>
                    <tr>
                        <td><strong>{{experience.position}}</strong></td>
                        <td align="right" class="muted">{{experience.duration}}</td>
                    </tr>
                </table>
                <div class="muted">{{experience.company}}</div>
                <div>{{experience.description}}</div>
            </div>
            {{experience.endloop}}
        </div>

        <!-- EDUCATION -->
        <div class="section">
            <div class="section-title">Education</div>

            {{education.loop}}
            <div class="item">
                <table>
                    <tr>
                        <td><strong>{{education.degree}}</strong></td>
                        <td align="right" class="muted">{{education.year}}</td>
                    </tr>
                </table>
                <div class="muted">{{education.institute}}</div>
            </div>
            {{education.endloop}}
        </div>

        <!-- SKILLS -->
        <div class="section">
            <div class="section-title">Skills</div>
            {{skills.loop}}
            <span class="skill">{{skills.name}}</span>
            {{skills.endloop}}
        </div>

        <!-- SOCIAL -->
        <div class="section">
            <div class="section-title">Social Profiles</div>

            {{social.loop}}
            <div class="muted">{{social.platform}} : {{social.url}}</div>
            {{social.endloop}}
        </div>

    </div>

</body>

</html>