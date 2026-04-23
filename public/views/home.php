<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Alert!</title>
    <link rel="stylesheet" href="../assets/tooplate-strategic-style.css">
    <style>
        
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#home" class="logo">
                <img src="../assets/images/logo_semBG.png" alt="Logo Screen exemplo" width="80" height="80" loading="lazy">
                <span>Screen Alert!</span>
            </a>
            <ul class="nav-links">
                <li><a href="#home"        id="nav-home">Home</a></li>
                <li><a href="#services"    id="nav-services">Services</a></li>
                <li><a href="#team"        id="nav-team">Team</a></li>
                <li><a href="#programming" id="nav-programming">Programming Languages</a></li>
                <li><a href="#softwares"   id="nav-softwares">Used Softwares</a></li>
                <li><a href="login"   class="nav-button" id="nav-login">Login</a></li>
                <li><button id="lang-btn"  class="nav-button" onclick="toggleLanguage()">🇵🇹 PT</button></li>
            </ul>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="geometric-shapes">
            <div class="geo-shape"></div>
            <div class="geo-shape"></div>
            <div class="geo-shape"></div>
            <div class="geo-shape"></div>
            <div class="geo-shape"></div>
        </div>
        <div class="hero-content">
            <h1 id="hero-headline">Screen<br>Alert!</h1>
            <p id="hero-paragraph">At Screen Alert!, we fight so that everyone can be helped.</p>
            <a href="#services" class="cta-button" id="hero-cta">Begin Your Journey</a>
        </div>
    </section>

    <section id="services" class="services">
        <div class="section services-container">
            <h2 class="section-title fade-in" id="services-title">Our Goals</h2>
            <div class="services-layout">
                <div class="services-content">
                    <div class="service-details active" data-service="strategy">
                        <h3 id="goal1-title">Objective of our project</h3>
                        <div class="service-subtitle" id="goal1-subtitle">Remote Screens Receivers</div>
                        <p id="goal1-desc">In our project, we intend to create remote screens that receive messages sent from the application and display them on the screen, in order to remind people at home, if necessary, to take medication, do chores, and things of that nature.</p>
                    </div>
                    <div class="service-details" data-service="digital">
                        <h3 id="goal2-title">Connect the application to the screen.</h3>
                        <p id="goal2-desc">To establish a connection between the application and the screen, so that a message can be sent from the application to the screen, making it possible to see if the message is displayed on the screen.</p>
                    </div>
                    <div class="service-details" data-service="performance">
                        <h3 id="goal3-title">Selling the screens and being able to help those in need.</h3>
                        <p id="goal3-desc">Our main goal is to make our screens available through the app, allowing us to help those in need.</p>
                    </div>
                <div class="services-tabs">
                    <div class="service-tab active" data-target="strategy">
                        <div class="tab-icon">📺</div>
                        <div class="tab-content">
                            <h4 id="tab1-label">Objective of our project</h4>
                        </div>
                    </div>
                    <div class="service-tab" data-target="digital">
                        <div class="tab-icon">⚡</div>
                        <div class="tab-content">
                            <h4 id="tab2-label">Connect the application to the screen.</h4>
                        </div>
                    </div>
                    <div class="service-tab" data-target="performance">
                        <div class="tab-icon">📊</div>
                        <div class="tab-content">
                            <h4 id="tab3-label">Selling the screens and being able to help those in need.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team">
        <div class="section">
            <h2 class="section-title fade-in" id="team-title">Strategic Visionaries</h2>
            <div class="team-grid">
                <div class="team-member fade-in">
                    <div class="member-card">
                        <div class="member-avatar">
                            <img src="../assets/images/team-member-01.jpg" alt="Rodrigo Pereira" />
                        </div>
                        <div class="member-info">
                            <h3>Rodrigo Pereira</h3>
                            <div class="member-role" id="role-rodrigo">Developer</div>
                            <p id="bio-rodrigo">17 years old student, Developer, Systems Programming Technician.</p>
                        </div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar">
                            <img src="../assets/images/team-member-02.jpeg" alt="Karamjit Singh" />
                        </div>
                        <div class="member-info">
                            <h3>Karamjit Singh</h3>
                            <div class="member-role" id="role-karam">Developer</div>
                            <p id="bio-karam">18 years old student, Developer, Systems Programming Technician.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="programming" class="languages">
        <div class="section">
            <h2 class="section-title fade-in" id="programming-title">Programming Languages</h2>
            <div class="team-grid">
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/Java_logo.jpg" alt="Java Logo" /></div>
                        <div class="member-info"><h3>Java</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/Javascript_logo.webp" alt="JavaScript Logo" /></div>
                        <div class="member-info"><h3>JavaScript</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/HTML_logo.jpg" alt="HTML Logo" /></div>
                        <div class="member-info"><h3>HTML</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/Python_logo.jpg" alt="Python Logo" /></div>
                        <div class="member-info"><h3>Python</h3></div>
                    </div>
                </div>
                <div class="team-member fade-in">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/PHP_logo.webp" alt="PHP Logo" /></div>
                        <div class="member-info"><h3>PHP</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/XML_logo.jpg" alt="XML Logo" /></div>
                        <div class="member-info"><h3>XML</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/css_logo.png" alt="CSS Logo" /></div>
                        <div class="member-info"><h3>CSS</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/sql_logo.jpg" alt="SQL Logo" /></div>
                        <div class="member-info"><h3>SQL</h3></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="softwares" class="languages">
        <div class="section">
            <h2 class="section-title fade-in" id="softwares-title">Used Softwares</h2>
            <div class="team-grid">
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/RaspberryPi_logo.webp" alt="RaspberryPi Logo" /></div>
                        <div class="member-info"><h3>Raspberry Pi</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/GitHub_logo.webp" alt="GitHub Logo" /></div>
                        <div class="member-info"><h3>GitHub</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/VScode_logo.png" alt="VSCode Logo" /></div>
                        <div class="member-info"><h3>Visual Studio Code</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/Git_logo.jpg" alt="Git Logo" /></div>
                        <div class="member-info"><h3>Git</h3></div>
                    </div>
                </div>
                <div class="team-member fade-in">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/AndroidStudio_logo.png" alt="AndroidStudio Logo" /></div>
                        <div class="member-info"><h3>Android Studio</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/phpMyadmin_logo.jpg" alt="PHPMyAdmin Logo" /></div>
                        <div class="member-info"><h3>PHPMyAdmin</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/Spyder_logo.webp" alt="Spyder Logo" /></div>
                        <div class="member-info"><h3>Spyder</h3></div>
                    </div>
                </div>
                <div class="team-member fade-on">
                    <div class="member-card">
                        <div class="member-avatar"><img src="../assets/images/MySQL_logo.webp" alt="MySQL Logo" /></div>
                        <div class="member-info"><h3>MySQL</h3></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="#privacy" id="footer-privacy">Privacy Policy</a>
                <a href="#terms"   id="footer-terms">Terms of Service</a>
                <a href="#careers" id="footer-careers">Careers</a>
            </div>
            <div class="footer-copyright" id="footer-copy">
                © 2025 StrategicPro. All rights reserved.
            </div>
            <div class="footer-design">
                Design: <a href="https://www.tooplate.com" target="_blank">Tooplate</a>
            </div>
        </div>
    </footer>

<script src="../assets/tooplate-strategic-scripts.js"></script>
<script>
    const translations = {
        en: {
            "nav-home":          "Home",
            "nav-services":      "Services",
            "nav-team":          "Team",
            "nav-programming":   "Programming Languages",
            "nav-softwares":     "Used Softwares",
            "nav-login":         "Login",
            "hero-paragraph":    "At Screen Alert!, we fight so that everyone can be helped.",
            "hero-cta":          "Begin Your Journey",
            "services-title":    "Our Goals",
            "goal1-title":       "Objective of our project",
            "goal1-subtitle":    "Remote Screens Receivers",
            "goal1-desc":        "In our project, we intend to create remote screens that receive messages sent from the application and display them on the screen, in order to remind people at home, if necessary, to take medication, do chores, and things of that nature.",
            "goal2-title":       "Connect the application to the screen.",
            "goal2-desc":        "To establish a connection between the application and the screen, so that a message can be sent from the application to the screen, making it possible to see if the message is displayed on the screen.",
            "goal3-title":       "Selling the screens and being able to help those in need.",
            "goal3-desc":        "Our main goal is to make our screens available through the app, allowing us to help those in need.",
            "tab1-label":        "Objective of our project",
            "tab2-label":        "Connect the application to the screen.",
            "tab3-label":        "Selling the screens and being able to help those in need.",
            "team-title":        "Strategic Visionaries",
            "role-rodrigo":      "Developer",
            "bio-rodrigo":       "17 years old student, Developer, Systems Programming Technician.",
            "role-karam":        "Developer",
            "bio-karam":         "18 years old student, Developer, Systems Programming Technician.",
            "programming-title": "Programming Languages",
            "softwares-title":   "Used Softwares",
            "footer-privacy":    "Privacy Policy",
            "footer-terms":      "Terms of Service",
            "footer-careers":    "Careers",
            "footer-copy":       "© 2025 StrategicPro. All rights reserved.",
            "lang-btn":          "🇵🇹 PT"
        },
        pt: {
            "nav-home":          "Início",
            "nav-services":      "Serviços",
            "nav-team":          "Equipa",
            "nav-programming":   "Linguagens de Programação",
            "nav-softwares":     "Softwares Utilizados",
            "nav-login":         "Entrar",
            "hero-paragraph":    "Na Screen Alert!, lutamos para que todos possam ser ajudados.",
            "hero-cta":          "Começa a Tua Jornada",
            "services-title":    "Os Nossos Objetivos",
            "goal1-title":       "Objetivo do nosso projeto",
            "goal1-subtitle":    "Ecrãs Recetores Remotos",
            "goal1-desc":        "No nosso projeto, pretendemos criar ecrãs remotos que recebem mensagens enviadas pela aplicação e as exibem no ecrã, com o objetivo de lembrar as pessoas em casa de, se necessário, tomar medicação, fazer tarefas domésticas e coisas do género.",
            "goal2-title":       "Ligar a aplicação ao ecrã.",
            "goal2-desc":        "Estabelecer uma ligação entre a aplicação e o ecrã, para que uma mensagem possa ser enviada da aplicação para o ecrã, tornando possível verificar se a mensagem é exibida no ecrã.",
            "goal3-title":       "Vender os ecrãs e poder ajudar quem precisa.",
            "goal3-desc":        "O nosso principal objetivo é disponibilizar os nossos ecrãs através da aplicação, permitindo ajudar quem necessita.",
            "tab1-label":        "Objetivo do nosso projeto",
            "tab2-label":        "Ligar a aplicação ao ecrã.",
            "tab3-label":        "Vender os ecrãs e poder ajudar quem precisa.",
            "team-title":        "Os Nossos Visionários",
            "role-rodrigo":      "Programador",
            "bio-rodrigo":       "Estudante de 17 anos, Programador, Técnico de Programação de Sistemas.",
            "role-karam":        "Programador",
            "bio-karam":         "Estudante de 18 anos, Programador, Técnico de Programação de Sistemas.",
            "programming-title": "Linguagens de Programação",
            "softwares-title":   "Softwares Utilizados",
            "footer-privacy":    "Política de Privacidade",
            "footer-terms":      "Termos de Serviço",
            "footer-careers":    "Carreiras",
            "footer-copy":       "© 2025 StrategicPro. Todos os direitos reservados.",
            "lang-btn":          "🇬🇧 EN"
        }
    };

    let currentLang = "en";

    function toggleLanguage() {
        currentLang = currentLang === "en" ? "pt" : "en";
        const t = translations[currentLang];
        for (const id in t) {
            const el = document.getElementById(id);
            if (el) el.textContent = t[id];
        }
        document.documentElement.lang = currentLang;
    }
</script>
</body>
</html>