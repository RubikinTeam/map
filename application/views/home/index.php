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
    <table class = "table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <td>Time</td>
            <td>content</td>
            <td>Like</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) {
            ?>
            <tr>
                <td><?php echo $comment->date; ?></td>
                <td><?php echo $comment->content; ?></td>
                <td><?php echo $comment->like; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
