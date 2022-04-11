<!DOCTYPE html>
<html lang="en">

<head>
    <title>Curriculum Vitae - SWACV</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Resume/CV Template for Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    {{-- <link rel="shortcut icon" href="favicon.ico"> --}}
    <!-- Google Font -->
    <link href="{{ asset('orbit/assets/css/fontroboto.css') }}" rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('orbit/assets/fontawesome/css/all.css') }}" type='text/css'>


    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('orbit/assets/plugins/bootstrap/css/bootstrap.min.css') }} ">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('orbit/assets/css/orbit-1.css') }}">

</head>

<body>

    <main>
        <div class="wrapper mt-lg-5">
            <div class="sidebar-wrapper">
                <div class="profile-container">
                    @if (isset($data['persona']->Foto) && $data['persona']->Foto != '')
                        <img src="{{ $data['persona']->Foto }}" class="profile"
                            style="border-radius: 50%;width:120px">
                    @else
                        <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" class="profile"
                            style="border-radius: 50%;width:120px">
                    @endif

                    <h1 class="name">{{ $data['persona']->fullname }}</h1>
                    <h3 class="tagline">Curriculum Vitae</h3>
                </div>
                <!--//profile-container-->

                <div class="contact-container container-block">
                    <ul class="list-unstyled contact-list">
                        <li class="email"><i class="fas fa-envelope"></i> &nbsp;<a
                                href="mailto: yourname@email.com"
                                style="top: -4px;position: relative">{{ $data['persona']->PE_CORREO }}</a></li>
                        <li class="phone"><i class="fas fa-phone"></i> &nbsp;<a
                                href="tel:{{ $data['persona']->PE_NUM_CEL }}"
                                style="top: -4px;position: relative">{{ $data['persona']->PE_NUM_CEL }}</a></li>

                        <li class="linkedin"><i class="fab fa-linkedin-in"></i> &nbsp;<a
                                href="{{ $data['persona']->PE_LINKEDIN }}" target="_blank"
                                style="top: -4px;position: relative">LinkedIN</a></li>

                    </ul>
                </div>
                <!--//contact-container-->
                <div class="education-container container-block">
                    <h2 class="container-block-title">Educación</h2>
                    @foreach ($data['estudios'] as $row)
                        <div class="item">
                            <span class="degree" style="font-size: 12px">{{ $row->EST_PROFESION }}</span><br>
                            <span class="meta"
                                style="font-size: 10px">{{ $row->EST_CENTRO_ESTU }}</span><br>
                            <div class="time" style="font-size: 9px">{{ $row->EST_ANIO_INICIO }} -
                                {{ $row->EST_ANIO_FIN }}</div>
                        </div>
                    @endforeach

                    <!--//item-->

                </div>
                <!--//education-container-->
                <div class="languages-container container-block">
                    <h2 class="container-block-title">Idiomas</h2>
                    <ul class="list-unstyled interests-list">
                        @foreach ($data['idiomas'] as $row)
                            <li>{{ $row->IDI_IDIOMA }} <span class="lang-desc"
                                    style="font-size: 9px">{{ $row->IDI_NIVEL }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!--//interests-->
                <div class="interests-container container-block">
                    <h2 class="container-block-title">Intereses</h2>
                    <ul class="list-unstyled interests-list">
                        @foreach ($data['intereses'] as $row)
                            <li style="font-size: 10px">{{ $row->INTE_TIPO }}</li>
                        @endforeach
                    </ul>
                </div>
                <!--//interests-->

            </div>
            <!--//sidebar-wrapper-->

            <div class="main-wrapper">

                <section class="section summary-section">
                    <h2 class="section-title"><span class="icon-holder"><i class="fas fa-user"></i></span>Perfil
                        Laboral</h2>
                    <div class="summary">
                        <p>{{ $data['persona']->PE_PERFIL }}
                        </p>
                    </div>
                    <!--//summary-->
                </section>
                <!--//section-->

                <section class="section experiences-section">
                    <h2 class="section-title"><span class="icon-holder"><i
                                class="fas fa-briefcase"></i></span>Experiencias</h2>

                    <div class="item">
                        <div class="meta">
                            <div class="upper-row">
                                <h3 class="job-title">Lead Developer</h3>
                                <div class="time">2019 - Present</div>
                            </div>
                            <!--//upper-row-->
                            <div class="company">Startup Hubs, San Francisco</div>
                        </div>
                        <!--//meta-->
                    </div>

                    <div class="item">
                        <div class="meta">
                            <div class="upper-row">
                                <h3 class="job-title">Senior Software Engineer</h3>
                                <div class="time">2018 - 2019</div>
                            </div>
                            <!--//upper-row-->
                            <div class="company">Google, London</div>
                        </div>

                    </div>
                    <!--//item-->

                    <div class="item">
                        <div class="meta">
                            <div class="upper-row">
                                <h3 class="job-title">UI Developer</h3>
                                <div class="time">2016 - 2018</div>
                            </div>
                            <!--//upper-row-->
                            <div class="company">Amazon, London</div>
                        </div>

                    </div>
                    <!--//item-->

                </section>
                <!--//section-->

                <section class="section projects-section">
                    <h2 class="section-title"><span class="icon-holder"><i
                                class="fas fa-archive"></i></span>Proyectos</h2>

                    <!--//intro-->
                    <div class="item">
                        <span class="project-title"><a
                                href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/"
                                target="_blank">CoderPro</a></span> - <span class="project-tagline">A responsive website
                            template designed to help developers launch their software projects. </span>

                    </div>
                    <!--//item-->
                    <div class="item">
                        <span class="project-title"><a
                                href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/launch-bootstrap-5-template-for-saas-businesses/"
                                target="_blank">Launch</a></span> - <span class="project-tagline">A responsive website
                            template designed to help startups promote their products or services.</span>
                    </div>
                    <!--//item-->
                    <div class="item">
                        <span class="project-title"><a
                                href="https://themes.3rdwavemedia.com/bootstrap-templates/resume/devcard-bootstrap-5-vcard-portfolio-template-for-software-developers/"
                                target="_blank">DevCard</a></span> - <span class="project-tagline">A portfolio website
                            template designed for software developers.</span>
                    </div>
                    <!--//item-->
                    <div class="item">
                        <span class="project-title"><a
                                href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/bootstrap-template-for-mobile-apps-nova-pro/"
                                target="_blank">Nova Pro</a></span> - <span class="project-tagline">A responsive
                            Bootstrap theme designed to help app developers promote their mobile apps</span>
                    </div>
                    <!--//item-->
                    <div class="item">
                        <span class="project-title"><a
                                href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-web-development-agencies-devstudio/"
                                target="_blank">DevStudio</a></span> -
                        <span class="project-tagline">A responsive website template designed to help web
                            developers/designers market their services. </span>
                    </div>
                    <!--//item-->
                </section>
                <!--//section-->

                <section class="skills-section section">
                    <h2 class="section-title"><span class="icon-holder"><i
                                class="fas fa-rocket"></i></span>Habilidades
                        &amp; Competencias</h2>
                    <div class="skillset">
                        <div class="item">
                            {{-- <h3 class="level-title">Python &amp; Django</h3> --}}
                            <h3 class="level-title">Python &amp; Django</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 99%;height: 10px;" aria-valuenow="99" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>

                        </div>
                        <!--//item-->

                        <div class="item">
                            <h3 class="level-title">Javascript</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 98%;height: 10px;" aria-valuenow="98" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--//item-->

                        <div class="item">
                            <h3 class="level-title">React &amp; Angular</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 98%;height: 10px;" aria-valuenow="98" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--//item-->

                        <div class="item">
                            <h3 class="level-title">HTML5 &amp; CSS</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 95%;height: 10px;" aria-valuenow="95" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--//item-->

                        <div class="item">
                            <h3 class="level-title">Ruby on Rails</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 85%;height: 10px;" aria-valuenow="85" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--//item-->

                        <div class="item">
                            <h3 class="level-title">Sketch &amp; Photoshop</h3>
                            <div class="progress level-bar">
                                <div class="progress-bar theme-progress-bar" role="progressbar"
                                    style="width: 60%;height: 10px;" aria-valuenow="60" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--//item-->

                    </div>
                </section>
                <!--//skills-section-->

            </div>
            <!--//main-body-->
        </div>
    </main>
    <footer>
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 20%; text-align: left;">
                        SWACV
                    </td>
                    <td style="width: 40%; text-align: right;"> Designed on swacv.online</td>
                    <td style="width: 30%; text-align: right;">
                        <img src="{{ asset('adminlte/dist/img/logo/logo.svg') }}">
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>
</body>

</html>
