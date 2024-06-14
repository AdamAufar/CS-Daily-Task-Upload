<?php
if (isset($_SESSION['success_message']) || isset($_SESSION['error_message'])): ?>
    <div id="popup" class="popup" style="background-color: <?php echo isset($_SESSION['success_message']) ? '#4CAF50' : '#f44336'; ?>">
        <?php 
        if (isset($_SESSION['success_message'])) {
            echo $_SESSION['success_message']; 
            unset($_SESSION['success_message']); 
        } 
        if (isset($_SESSION['error_message'])) {
            echo $_SESSION['error_message']; 
            unset($_SESSION['error_message']); 
        }
        ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const popup = document.getElementById('popup');
            popup.classList.add('show');
            setTimeout(() => {
                popup.classList.remove('show');
            }, 3000);
        });
    </script>
<?php endif; ?>
