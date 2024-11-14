// Login page translations
const translations = {
    en: {
        title: "Log Into Your Account",
        emailPlaceholder: "Email Address",
        passwordPlaceholder: "Password",
        submitButton: "Submit",
        switchBtn: "عربي"
    },
    ar: {
        title: "تسجيل الدخول إلى حسابك",
        emailPlaceholder: "البريد الإلكتروني",
        passwordPlaceholder: "كلمة المرور",
        submitButton: "تسجيل الدخول",
        switchBtn: "English"
    }
};

const languageManager = {
    init() {
        // Set initial language from localStorage or default to Arabic
        const savedLang = localStorage.getItem('preferredLanguage') || 'ar';
        this.setLanguage(savedLang);
        
        // Add event listener to language toggle button
        const langToggle = document.querySelector('.lang-toggle');
        if (langToggle) {
            langToggle.addEventListener('click', () => this.toggleLanguage());
        }
    },

    setLanguage(lang) {
        const html = document.documentElement;
        html.lang = lang;
        html.dir = lang === 'ar' ? 'rtl' : 'ltr';
        
        // Update content
        this.updateContent(lang);
        
        // Save preference
        localStorage.setItem('preferredLanguage', lang);
    },

    updateContent(lang) {
        // Update title
        document.querySelector('h1').textContent = translations[lang].title;
        
        // Update form placeholders
        document.querySelector('#seller_email').placeholder = translations[lang].emailPlaceholder;
        document.querySelector('#seller_password').placeholder = translations[lang].passwordPlaceholder;
        
        // Update submit button
        document.querySelector('#seller_login').value = translations[lang].submitButton;
        
        // Update language toggle button visibility
        document.querySelectorAll('.lang-toggle .en, .lang-toggle .ar').forEach(el => {
            el.style.display = 'none';
        });
        document.querySelector(`.lang-toggle .${lang === 'en' ? 'ar' : 'en'}`).style.display = 'inline';
    },

    toggleLanguage() {
        const currentLang = document.documentElement.lang;
        this.setLanguage(currentLang === 'en' ? 'ar' : 'en');
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => languageManager.init());