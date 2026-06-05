// Dark mode — runs immediately to prevent FOUC
(function () {
            var s = localStorage.getItem('theme');
            if (s === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
})();
