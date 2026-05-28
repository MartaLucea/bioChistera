<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investigació: Back Market | BioChistera</title>
    <link rel="stylesheet" href="/public/css/backMarket.css">
</head>
<body>
      <?php include_once '../layout/header.php'; ?>
    <main class="investigacio-backmarket-container">

        <div class="report-grid">
            
            <aside class="report-sidebar">
                <section class="info-box">
                    <h3>Puntuació B Corp</h3>
                    <div class="bcorp-circle">
                        <span class="number">93.2</span>
                        <span class="label">B-Impact</span>
                    </div>
                    <ul class="bcorp-list">
                        <li><strong>Treballadors:</strong> 32,4 pts</li>
                        <li><strong>Medi Ambient:</strong> 24,8 pts</li>
                        <li><strong>Comunitat:</strong> 15,0 pts</li>
                    </ul>
                </section>

                <section class="info-box accent">
                    <h3>Valoració de Mercat</h3>
                    <div class="market-stat">
                        <span class="value">5.000M $</span>
                        <p>L'empresa de recondicionat més gran d'Europa.</p>
                    </div>
                </section>

                <section class="info-box">
                    <h3>Aliança Stakeholders</h3>
                    <p>Col·laboració amb <strong>Google (ChromeOS Flex)</strong> i <strong>Closing the Loop</strong> per a la gestió de residus a països en vies de desenvolupament.</p>
                </section>
            </aside>

            <article class="report-main">
                <section class="report-section">
                    <h2>El Repte del "Fast Tech"</h2>
                    <p>L'acceleració digital ha disparat el rebuig d'electrònica. S'estima que per al 2040, la petjada de carboni digital representarà el <strong>14% de les emissions globals</strong>. Back Market s'oposa a aquest model promovent el recondicionament sistemàtic.</p>
                </section>

                <section class="report-section">
                    <h2>Estalvi de Recursos (Estudi ADEME)</h2>
                    <p>Dades comparatives d'estalvi de recursos d'un dispositiu recondicionat vs. un de nou:</p>
                    
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Dispositiu</th>
                                    <th>CO2 Estalviat</th>
                                    <th>Aigua Estalviada</th>
                                    <th>Matèries Primeres</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Smartphone</td>
                                    <td class="highlight-v">91,6%</td>
                                    <td>86,4%</td>
                                    <td>91,3%</td>
                                </tr>
                                <tr>
                                    <td>Tablet / iPad</td>
                                    <td class="highlight-v">88,1%</td>
                                    <td>99,9%</td>
                                    <td>99,2%</td>
                                </tr>
                                <tr>
                                    <td>Ordinador Portàtil</td>
                                    <td class="highlight-v">88,9%</td>
                                    <td>97,3%</td>
                                    <td>95,8%</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Font: Agència Francesa de Transició Ecològica (ADEME).</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </section>

                <section class="report-section">
                    <h2>Model "Mission Locked"</h2>
                    <p>Back Market no només busca el benefici; la seva estructura legal protegeix la missió social. Amb iniciatives com els <strong>"Protesting Days"</strong>, els empleats disposen de 2 dies pagats a l'any per dedicar-se a l'activisme ambiental o social.</p>
                </section>
            </article>

        </div>
    </div>
</main>

    <?php include_once __DIR__ . "/../layout/footer.html"; ?>

</body>
</html>