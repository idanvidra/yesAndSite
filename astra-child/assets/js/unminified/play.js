document.addEventListener('DOMContentLoaded', () => {   
    window.setInterval(function() {
        const uid = getCookie('uid');

        if (uid !== '') {
            const fetchURL = adminAjax + '?action=find_match&uid=' + uid;
            fetch(fetchURL)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                });
        }
    }, 5000);
});