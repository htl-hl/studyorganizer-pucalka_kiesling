    <?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <?php

        /** @var yii\web\View $this */

        $this->title = 'Dashboard';
        ?>
        <div class="site-index">
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>Title</th>
                        <th>Fach</th>
                        <th>Lehrer</th>
                        <th>Fälligkeitsdatum</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Keine Daten vorhanden</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
