// Main JavaScript file for Kohabit

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Kohabit web application loaded successfully!');

    // Smooth scrolling for navigation links
    setupSmoothScrolling();

    // Contact form handling
    setupContactForm();

    // CTA button handler
    setupCTAButton();
});

/**
 * Setup smooth scrolling for navigation links
 */
function setupSmoothScrolling() {
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                const headerOffset = 70;
                const elementPosition = targetSection.offsetTop;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Setup contact form submission
 */
function setupContactForm() {
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                message: formData.get('message')
            };

            // Validate form data
            if (validateForm(data)) {
                // Send data to backend
                submitFormData(data)
                    .then(response => {
                        showMessage('Message sent successfully!', 'success');
                        contactForm.reset();
                    })
                    .catch(error => {
                        showMessage('Error sending message. Please try again.', 'error');
                        console.error('Form submission error:', error);
                    });
            } else {
                showMessage('Please fill in all fields correctly.', 'error');
            }
        });
    }
}

/**
 * Validate form data
 */
function validateForm(data) {
    if (!data.name || data.name.trim() === '') return false;
    if (!data.email || !isValidEmail(data.email)) return false;
    if (!data.message || data.message.trim() === '') return false;
    return true;
}

/**
 * Validate email format
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Submit form data to backend
 */
async function submitFormData(data) {
    try {
        const response = await fetch('php/submit_form.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return await response.json();
    } catch (error) {
        throw error;
    }
}

/**
 * Show form message
 */
function showMessage(message, type) {
    const formMessage = document.getElementById('formMessage');
    
    if (formMessage) {
        formMessage.textContent = message;
        formMessage.className = 'form-message ' + type;
        
        // Hide message after 5 seconds
        setTimeout(() => {
            formMessage.className = 'form-message';
            formMessage.textContent = '';
        }, 5000);
    }
}

/**
 * Setup CTA button
 */
function setupCTAButton() {
    const ctaButton = document.querySelector('.cta-button');
    
    if (ctaButton) {
        ctaButton.addEventListener('click', function() {
            // Scroll to contact section
            const contactSection = document.getElementById('contact');
            if (contactSection) {
                const headerOffset = 70;
                const elementPosition = contactSection.offsetTop;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    }
}

/**
 * Example function to fetch data from database
 */
async function fetchDataFromDatabase() {
    try {
        const response = await fetch('php/get_data.php');
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
}

/**
 * Example function to save data to database
 */
async function saveDataToDatabase(data) {
    try {
        const response = await fetch('php/save_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return await response.json();
    } catch (error) {
        console.error('Error saving data:', error);
        throw error;
    }
}
