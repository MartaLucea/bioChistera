<?php
require_once "../../controller/odsController.php";

    $ods = $_GET['ods'] ?? null;
    $data = getODSData($ods);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/ods.css">
    <title>BioChistera</title>
</head>
<body>
    <?php include_once 'header.php'; ?>

    <main>

        <section class="ods-detail-hero ods-detail-hero--<?php echo $ods ?>">
            <div class="contenidor">
                <p class="ods-hero__breadcrumb"><a href="../index.php">Inici</a> › <a href="index.php">ODS</a> ›
                    ODS <?php echo $ods ?></p>
                <div class="ods-detail-hero__inner">
                    <div class="ods-detail-hero__text">
                        <span class="ods-detail-hero__num"><?php echo str_pad($ods, 2, "0", STR_PAD_LEFT); ?></span>
                        <?php
                            echo $data['titol'];
                            echo $data['subtitol'];
                        ?>
                    </div>
                    <?php echo $data['img']?>
                </div>
            </div>
        </section>

        <section class="ods-detail-body">
            <div class="contenidor ods-detail-grid">

                <div class="ods-block">
                    <h2>Què és?</h2>
                    <?php echo $data['queEs']; ?>
                </div>
                
                <div class="ods-block ods-block--highlight">
                    <h2>El repte</h2>
                    <?php echo $data['quote']; echo $data['repte'];?>
                    
                </div>

                <div class="ods-block">
                    <h2>Com impacta BioChistera</h2>
                    <div class="ods-impacts">
                        <div class="ods-impact-item">
                            <?php echo $data['impactaItem1']?>
                        </div>
                        <div class="ods-impact-item">
                            <?php echo $data['impactaItem2']?>
                        </div>
                        <div class="ods-impact-item">
                            <?php echo $data['impactaItem3']?>                            
                        </div>
                    </div>
                </div>

                <div class="ods-block">
                    <h2>Impacte ASG</h2>
                    <div class="asg-grid">
                        <div class="asg-item asg-item--a">
                            <strong>Ambiental</strong>
                            <?php echo $data['ambiental'] ?>
                        </div>
                        <div class="asg-item asg-item--s">
                            <strong>Social</strong>
                            <?php echo $data['social'] ?>
                        </div>
                        <div class="asg-item asg-item--g">
                            <strong>Governança</strong>
                            <?php echo $data['govern'] ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <nav class="ods-nav">
            <div class="contenidor">
                <?php echo $data['nav']?>
            </div>
        </nav>

    </main>

    <?php include_once '../layout/footer.html'; ?>
</body>

</html>