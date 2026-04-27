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