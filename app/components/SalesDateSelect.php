<div class="p-3 text-center">
    <form action="" method="get">
        <div class="flex justify-center items-center space-x-2">
            <?php if (!empty($years)): ?>
                <select name="year" class="mr-2 p-2 border">
                    <option value="">年</option>
                    <?php foreach ($years as $year) : ?>
                        <option value="<?= $year ?>" <?= selected($year, $current_year) ?>><?= $year ?></option>
                    <?php endforeach ?>
                </select>
            <?php endif ?>

            <?php if (!empty($months)): ?>
                <select name="month" class="mr-2 p-2 border">
                    <option value="">月</option>
                    <?php foreach ($months as $month) : ?>
                        <option value="<?= $month ?>" <?= selected($month, $current_month) ?>><?= $month ?></option>
                    <?php endforeach ?>
                </select>
            <?php endif ?>
            <button class="bg-sky-500 text-white px-3 py-2 rounded">検索</button>
        </div>
    </form>
</div>