<?php

use app\assets\DependencyGraphAsset;
use app\helpers\Html;
use Yiisoft\Inflector\InflectorHelper;

/** @var array $sections */
/** @var array $allComposer */
/** @var string $title */
/** @var string $subTitle */
/** @var bool $hasDependencies */

$this->title = $title;
$this->subTitle = $subTitle;

DependencyGraphAsset::register($this);

?>

    <div class="row doc-section">
        <div class="doc-content col-md-9 col-12 order-1">
            <h1>Yii 3 packages</h1>
            <table class="table">
                <?php foreach ($sections as $section => $packages): ?>
                    <tr id="<?= InflectorHelper::slug($section) ?>" class="section">
                        <th colspan="2"><?= $section ?></th>
                        <th></th>
                    </tr>
                    <?php foreach ($packages as $package): ?>
                        <tr>
                            <td style="width: 1px;">
                                <?= Html::a(Html::o('mark-github'), 'https://github.com/yiisoft/' . $package->name, ['class' => 'float-right']) ?>
                            </td>
                            <td>
                                <?= Html::a($package->name, ['site/package', 'package' => $package->name]) ?>
                            </td>
                            <td>
                                <?php $ns = key($allComposer[$package->name]['autoload']['psr-4'] ?? []) ?>
                                <?= strpos($ns, 'Yiisoft') === 0 ? rtrim($ns, '\\') : '<span style="color: var(--red);">' . rtrim($ns, '\\') . '</span>' ?>
                            </td>
                            <td>
                                <?= Html::travisBadge($package->name, $package->travis) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
            </table>
        </div>
        <div class="doc-sidebar col-md-3 col-12 order-0 d-none d-md-flex">
            <div id="doc-nav" class="doc-nav">

                <nav id="doc-menu" class="nav doc-menu flex-column sticky">
<?php foreach ($sections as $section => $packages): ?>
                    <a class="nav-link scrollto" href="#<?=InflectorHelper::slug($section) ?>"><?= $section ?></a>
<?php endforeach; ?>
                </nav><!--//doc-menu-->
            </div>
        </div>
    </div>
    <hr/>


<?php if (true && $hasDependencies): ?>
    <p id="dependencies">
        Below is a dependency graph between Yii 3 packages generated by scanning the <code>require</code> section
        of each package <em>composer.json</em> file.
    </p>

    <div id="graph"></div>
    <small><a href="http://bl.ocks.org/jkschneider/c7660044fe74ab9ee53e">credits</a></small>

<?php else: ?>
    <p id="dependencies">
        A dependency graph can be generated using d3 js and displayed in this page.
    </p>
    <pre><code>
# clone all yii3 repositories (as defined in `config/params.php`)
./yii github/clone

# generate the dependencies json file
/yii packages/d3
</code></pre>
<?php endif ?>