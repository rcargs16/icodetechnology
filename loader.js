// Function to load and show preloader
function loadPreloader() {
    fetch('preloader.html')
        .then(response => response.text())
        .then(data => {
            // Create temporary container
            const temp = document.createElement('div');
            temp.innerHTML = data;
            
            // Get only the preloader content
            const preloader = temp.querySelector('.preloader');
            document.body.insertBefore(preloader, document.body.firstChild);
            
            // Hide main content initially
            document.getElementById('main-content').style.display = 'none';
            
            // Show main content after delay
            setTimeout(() => {
                preloader.style.display = 'none';
                const mainContent = document.getElementById('main-content');
                mainContent.style.display = 'block';
                mainContent.style.opacity = '1';
            }, 3000);
        });
}

// Load preloader when page loads
document.addEventListener('DOMContentLoaded', loadPreloader);

// Load preloader when navigation links are clicked
document.addEventListener('click', (e) => {
    if (e.target.tagName === 'A' || 
        (e.target.tagName === 'SPAN' && e.target.closest('.nav-links'))) {
        e.preventDefault();
        loadPreloader();
    }
});
