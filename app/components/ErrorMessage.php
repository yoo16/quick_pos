<?php if (isset($error)): ?>
    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>