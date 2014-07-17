<div class="container">
    <h2>You are in the View: application/views/home/index.php (everything in the box comes from this file)</h2>

    <p>In a real application this could be the homepage.</p>
    <table class = "table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <td>Time</td>
            <td>Title</td>
            <td>Source</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) {
            ?>
            <tr>
                <td><?php echo $article->date; ?></td>
                <td><?php echo $article->title; ?></td>
                <td><?php echo $article->sumary; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
