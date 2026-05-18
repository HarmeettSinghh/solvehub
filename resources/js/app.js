import './bootstrap';

/*
|--------------------------------------------------------------------------
| SolveHub JavaScript
|--------------------------------------------------------------------------
| Handles AJAX voting and interactive UI behaviors.
*/

// AJAX Voting System
document.addEventListener('DOMContentLoaded', function () {
    // Handle vote forms via AJAX
    document.querySelectorAll('.vote-form').forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });

                if (response.ok) {
                    const data = await response.json();

                    // Update the vote score display
                    const scoreEl = this.closest('.flex.flex-col')?.querySelector('.vote-score');
                    if (scoreEl) {
                        scoreEl.textContent = data.score;
                    }
                } else {
                    // If not authenticated, redirect to login
                    if (response.status === 401) {
                        window.location.href = '/login';
                    }
                }
            } catch (error) {
                console.error('Vote error:', error);
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        document.querySelectorAll('.relative > div.absolute').forEach(dropdown => {
            if (!dropdown.parentElement.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});
