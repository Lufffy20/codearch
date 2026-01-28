<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{personal.name}} - CV</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 13px;
            background: #fff;
            color: #333;
            margin: 0;
        }

        .wrapper {
            max-width: 900px;
            margin: auto;
            padding: 35px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        h3 {
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 12px;
            margin-top: 30px;
        }

        .muted {
            color: #777;
            font-size: 12px;
        }

        .section {
            margin-bottom: 25px;
        }

        .item {
            margin-bottom: 15px;
        }

        .skill {
            display: inline-block;
            background: #f2f2f2;
            padding: 5px 12px;
            margin: 3px;
            border-radius: 15px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <!-- ================= HEADER ================= -->
        <table>
            <tr>
                <td width="150">
                    <img src="{{image.profile}}"
                        style="width:120px;height:120px;border-radius:50%;border:1px solid #ccc;"
                        onerror="this.style.display='none'">
                </td>
                <td>
                    <h1>{{personal.name}}</h1>
                    <div class="muted">{{personal.role}}</div>
                    <div class="muted" style="margin-top:6px;">
                        {{personal.email}} |
                        {{personal.phone}} |
                        {{personal.location}}
                    </div>
                </td>
            </tr>
        </table>

        <!-- ================= SUMMARY ================= -->
        <div class="section">
            <h3>Profile Summary</h3>
            <p>{{personal.summary}}</p>
        </div>

        <!-- ================= EXPERIENCE ================= -->
        <div class="section">
            <h3>Experience</h3>

            {{experience.loop}}
            <div class="item">
                <table>
                    <tr>
                        <td><strong>{{experience.position}}</strong> — {{experience.company}}</td>
                        <td align="right" class="muted">{{experience.duration}}</td>
                    </tr>
                </table>
                <p>{{experience.description}}</p>
            </div>
            {{experience.endloop}}
        </div>

        <!-- ================= EDUCATION ================= -->
        <div class="section">
            <h3>Education</h3>

            {{education.loop}}
            <div class="item">
                <table>
                    <tr>
                        <td><strong>{{education.degree}}</strong> — {{education.institute}}</td>
                        <td align="right" class="muted">{{education.year}}</td>
                    </tr>
                </table>
            </div>
            {{education.endloop}}
        </div>

        <!-- ================= PROJECTS ================= -->
        <div class="section">
            <h3>Projects</h3>

            {{projects.loop}}
            <div class="item">
                <strong>{{projects.title}}</strong>
                <p>{{projects.description}}</p>
                <div class="muted">Tech: {{projects.tech}}</div>
            </div>
            {{projects.endloop}}
        </div>

        <!-- ================= SKILLS ================= -->
        <div class="section">
            <h3>Skills</h3>
            {{skills.loop}}
            <span class="skill">{{skills.name}}</span>
            {{skills.endloop}}
        </div>

        <!-- ================= LANGUAGES ================= -->
        <div class="section">
            <h3>Languages</h3>

            {{languages.loop}}
            <div class="item">
                {{languages.name}} – <span class="muted">{{languages.proficiency}}</span>
            </div>
            {{languages.endloop}}
        </div>

        <!-- ================= ACHIEVEMENTS ================= -->
        <div class="section">
            <h3>Achievements</h3>

            {{achievements.loop}}
            <div class="item">
                <strong>{{achievements.title}}</strong>
                <p>{{achievements.description}}</p>
            </div>
            {{achievements.endloop}}
        </div>

        <!-- ================= SOCIAL ================= -->
        <div class="section">
            <h3>Social Profiles</h3>

            {{social.loop}}
            <div class="item">
                {{social.platform}} : {{social.url}}
            </div>
            {{social.endloop}}
        </div>

    </div>

</body>

</html>