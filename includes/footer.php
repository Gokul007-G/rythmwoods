        </main> <!-- End Main Content -->
    </div> <!-- End App Wrapper -->

    <!-- Global Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    
    <!-- App Global JS -->
    <script src="/rythm/assets/js/main.js"></script>
    <script src="/rythm/assets/js/sidebar.js"></script>
    <script src="/rythm/assets/js/professional.js"></script>
    <script src="/rythm/assets/js/ui.js"></script>

    <?php if (isset($extraJS)): ?>
        <script src="<?php echo $extraJS; ?>"></script>
    <?php endif; ?>
</body>
</html>
