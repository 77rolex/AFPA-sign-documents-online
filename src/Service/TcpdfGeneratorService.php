<?php
// src\Service\TcpdfGeneratorService.php
namespace App\Service;

use TCPDF;
use App\Entity\Formulaire;
use App\Entity\Company;

class TcpdfGeneratorService
{
    public function generateFormulairePdf(Formulaire $formulaire, string $companyName): string
    {
        // Создаем новый PDF документ
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Настройка документа
        $pdf->SetCreator('CMFP System');
        $pdf->SetAuthor('CMFP');
        $pdf->SetTitle('Convention de Stage - ' . $formulaire->getSocietyName());
        $pdf->SetSubject('Convention de Stage');

        // Отключаем автоматический заголовок и подвал
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Устанавливаем margins
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        $pdf->SetMargins(10, 10, 10); // Уменьшаем отступы
        $pdf->SetAutoPageBreak(true, 10); // Уменьшаем нижний отступ

         // Размер шрифта
        // $pdf->SetFontSize(9);  // Компактный
        $pdf->SetFontSize(10); // Стандартный
        // $pdf->SetFontSize(11); // Крупный

        // Плотное расположение текста
        $pdf->setCellHeightRatio(0.85);
        $pdf->setFontSpacing(-0.05);

        // Уменьшаем межстрочный интервал
        $pdf->setCellHeightRatio(1.0);

        // Добавляем страницу
        $pdf->AddPage();

        // Генерируем HTML контент
        $html = $this->generateHtmlContent($formulaire, $companyName);

        // Записываем HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Возвращаем PDF как строку
        return $pdf->Output('', 'S');
    }

    private function generateHtmlContent(Formulaire $formulaire, string $companyName): string
    {
        // Здесь будет чистый HTML код
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: helvetica; font-size: 10pt; line-height: 1.4; }
                .logo-container { display: flex; justify-content: space-between; margin-bottom: 15px; }
                .logo { width: 75px; height: 75px; }
                .signature-container { margin-top: 30px; margin-bottom: 15px; }
                .signature-box { height: 40px; margin-bottom: 5px; }
                .signature-image { max-height: 50px; max-width: 150px; }
                .signature-label { font-style: italic; font-size: 9pt; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
                th, td { padding: 4px; text-align: left; vertical-align: top; }
                .border { border: 1px solid #000; padding: 5px; }
                .important { font-size: 9pt; font-style: italic; }
                .required-field { text-decoration: underline; }
                .text-center { text-align: center; }
                .mb-1 { margin-bottom: 5px; }
            </style>
        </head>
        <body>
            <table>
                <tr>
                    <td>
                       <img src="<?= $this->getImagePath('mda.png') ?>" class="logo" alt="MDA Logo">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                       <img src="<?= $this->getImagePath('afpa.png') ?>" class="logo" alt="AFPA Logo">
                    </td>
                </tr>
            </table>
            <div>
                <div>Fontenay le Comte, le <?= date('d/m/Y') ?></div>
                <div>Convention individuelle de stage PPE N°<span class="required-field"><?= $formulaire->getId() ?></span></div>
            </div>

            <div style="text-align:center; border:1px solid black; padding: 5px;">
                <strong>Convention individuelle fixant les conditions de séjour<br>
                d'un(e) stagiaire du CMFP en période pratique en entreprise.</strong>
            </div>
            <br>
            <div style="text-align:center;"><strong>Conclue entre : le Centre Militaire de Formation Professionnelle</strong></div>
            <div style="text-align:center;">21, boulevard Hoche<br>85200 Fontenay-le-Comte</div>

            <p><strong>agissant en partenariat avec l'association nationale pour la formation professionnelle des adultes</strong></p>
            
            <table>
                <tr>
                    <td style="width: 30%;">
                        <p>d'une part, et</p>
                        <p><strong>L'entreprise* :</strong></p>
                    </td>
                    <td style="width: 70%;">
                        <p><span><?= htmlspecialchars($formulaire->getSocietyName()) ?></span></p>
                        <p><span><?= htmlspecialchars($formulaire->getSocietyAdress()) ?></span></p>
                        <p>SIREN: <?= $formulaire->getSIRETSIREN() ?></p>
                    </td>
                </tr>
            </table>
            <p><strong>ARTICLE 1 :</strong><br>
                L'enseignement dispensé par l'AFPA, comporte une période en entreprise, permettant au stagiaire de se trouver confronté à un milieu réel de travail.<br>
                En conséquence, l'entreprise accepte de recevoir en son sein :</p>
            <p class="mb-1 border">Nom Prénom: <?= $formulaire->getStudent() ? htmlspecialchars($formulaire->getStudent()->getLastname() . ' ' . $formulaire->getStudent()->getFirstname()) : 'N/A' ?>, stagiaire au CMFP<br>
                en qualité de : <span class="required-field"><?= htmlspecialchars($formulaire->getQuality()) ?></span></p>
            <br>
            <p><strong>ARTICLE 2 :</strong><br>
            Au cours de cette période, le (la) stagiaire conserve son statut de militaire en reconversion et ne peut de ce
            fait prétendre à aucune rémunération de l'entreprise.</p>
            <p><strong>ARTICLE 3 :</strong><br>
            Le (la) stagiaire est associé (e) aux activités de l'entreprise concourant directement à l'action
            pédagogique. En aucun cas, sa participation à ces activités ne doit porter préjudice à la situation de l'emploi
            dans l'entreprise.</p>
            <p>Le (la) stagiaire devra se conformer au règlement intérieur de l'entreprise et aux consignes de sécurité
            afférentes aux travaux qui lui seront confiés.</p>
            <p>Il (elle) sera en outre, tenu (e) de respecter l'horaire d'activité appliqué par l'entreprise dans la limite
            maximale de la durée hebdomadaire du travail. En application de l'article L6343-1 du code du travail, il (elle)
            bénéficie du repos hebdomadaire.</p>
            <p><strong>ARTICLE 4 :</strong><br>
            Le (la) stagiaire est couvert(e) pendant son stage au titre du risque « accidents du travail – maladies
            professionnelles ». En cas d'accident du travail ou de trajet, le CMFP doit être informé
            immédiatement par téléphone. La déclaration d'accident est rédigée par l'entreprise qui la transmet ensuite
            au CMFP pour signature et identification avant expédition à la caisse de sécurité sociale.</p>
            <p><strong>ARTICLE 5 :</strong><br>
            L'AFPA, partenaire du CMFP, a souscrit une assurance responsabilité civile pour le compte du (de la)
            stagiaire. De son côté, l'entreprise d'accueil déclare à son ou ses assureurs la présence et l'activité du (de
            la) stagiaire.<br>
            L'entreprise d'accueil est informée que la conduite par le (la) stagiaire d'un de ses véhicules relèvera de sa
            seule responsabilité. Aussi devra-t-elle vérifier auprès de son assureur la prise en charge des sinistres qui
            pourraient survenir.</p>
            <p><strong>ARTICLE 6 :</strong><br>
            L'entreprise désigne M. ou Mme**: <span class="required-field"><?= htmlspecialchars($formulaire->getGuardianName()) ?></span> comme tuteur du (de la) stagiaire
            durant le stage.</p>
            <p>Cette personne, chargée d'initier le (la) stagiaire aux travaux qui lui seront confiés et de contrôler leur
            bonne exécution, sera la correspondante privilégiée du CMFP. Afin d'assurer le suivi du (de la)
            stagiaire, le tuteur est joignable aux coordonnées renseignées ci-dessous</p>
            <p><b>Courriel : </b><u><span class="required-field"><?= htmlspecialchars($formulaire->getGuardianEmail()) ?></span></u><b> N° de téléphone : </b><span class="required-field"><u><?= htmlspecialchars($formulaire->getGuardianPhone()) ?></u></span></p>
            <p><strong>ARTICLE 7 :</strong><br>
            Pendant toute la durée du séjour du (de la) stagiaire, M. ou Mme <span class="required-field"><?= htmlspecialchars($formulaire->getTrainerOfIntern()) ?></span>
            enseignant au centre AFPA de Fontenay Le Comte pourra rendre visite au (à la) stagiaire et prendre
            contact avec la personne responsable de l'intéressé(e) dans l'entreprise.<br>
            De même, le formateur AFPA pourra être sollicité à tout moment si un problème est constaté au cours
            du séjour du (de la) stagiaire dans l'entreprise.</p>
            <p><strong>ARTICLE 8 :</strong><br>
            Toute absence du (de la) stagiaire devra être signalée au CMFP, par téléphone dans un premier
            temps, puis confirmée sur la feuille de présence qui sera fournie à l'entreprise.</p>
            <p><strong>ARTICLE 9 :</strong><br>
            Le (la) stagiaire est assujetti(e) aux conditions d'hygiène et de sécurité fixées par le code du travail,
            notamment celles prévues en faveur des femmes.</p>
            <p><strong>ARTICLE 10 :</strong><br>
            Si des moyens de restauration existent au sein de l'entreprise, le (la) stagiaire pourra y avoir accès et
            acquittera le prix des repas consommés.</p>
            <p><strong>ARTICLE 11 :</strong><br>
            Au cas où l'entreprise est amenée à faire effectuer des déplacements au (à la) stagiaire, elle s'engage à
            en assumer les frais.</p>
            <p><strong>ARTICLE 12 :</strong><br>
            Le stage dans l'entreprise, <b>débutera le</b> <span class="required-field"><?= htmlspecialchars($formulaire->getStartDate()->format('d/m/Y')) ?></span> <b>et finira le</b> <span class="required-field"><?= htmlspecialchars($formulaire->getEndDate()->format('d/m/Y')) ?></span></p>
            <p>Chacune des parties ayant la faculté d'y mettre fin à tout moment et ce sans préavis, s'il s'avère que
            la présence du (de la) stagiaire crée des difficultés à l'entreprise ou si les termes de la présente
            convention ne sont pas respectés.</p>
            <p><strong>N° TPH utiles :</strong><br>
            Conseiller en formation : <span class="required-field"><?= htmlspecialchars($formulaire->getTrainingAdvisor()) ?></span><br>
            Formateur du stagiaire : <span class="required-field"><?= htmlspecialchars($formulaire->getTrainerOfIntern()) ?></span></p>
            <div class="signature-container">
                <p>Fait à Fontenay-le-Comte, le <?= date('d/m/Y') ?></p>
                <table>
                    <tr>
                        <td style="width: 50%; vertical-align: top; text-align:center">
                            <p>Le (la) stagiaire</p>
                            <div class="signature-box">
                                <?php if ($formulaire->getStudentSignature()): ?>
                                        <img class="signature-image" src="<?= $formulaire->getStudentSignature() ?>" alt="Signature Stagiaire">
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="width: 50%; vertical-align: top; text-align: center;">
                            <p>L'entreprise</p>
                            <div class="signature-box">
                                <?php if ($formulaire->getSocietySignature()): ?>
                                    <img class="signature-image" src="<?= $formulaire->getSocietySignature() ?>" alt="Signature Entreprise">
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </table>
                    
                <table>
                    <tr>
                        <td style="width: 50%; vertical-align: top; text-align: center;">
                            <p>Mr le directeur AFPA Vendée</p>
                            <div class="signature-box">
                                <?php if ($formulaire->getDirectorSignature()): ?>
                                    <img class="signature-image" src="<?= $formulaire->getDirectorSignature() ?>" alt="Signature Directeur">
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="width: 50%; vertical-align: top; text-align: center;">
                            <p>Commandant de Compagnie</p>
                            <div class="signature-box">
                                <?php if ($formulaire->getCommandantSignature()): ?>
                                    <img class="signature-image" src="<?= $formulaire->getCommandantSignature() ?>" alt="Signature Commandant">
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <p class="important">* N° SIRET ou SIREN obligatoire ;</p>
            <p class="important">** Par défaut, le chef d'entreprise ;</p>
            
            <p>Après signature du stagiaire et du chef d'entreprise, il est demandé de bien vouloir retourner ce
            document à l'adresse indiquée dans les meilleurs délais, par courrier ou par télécopie en cas de délai
            court.</p>
            
            <table>
                <tr>
                    <td style="width: 50%; vertical-align: top; text-align: center;">
                        Destinataires :
                    </td>
                    <td style="width: 50%; vertical-align: top; text-align: center;">
                        - L'entreprise ;<br>- Mr le directeur AFPA Vendée ;
                    </td>
                    <td style="width: 50%; vertical-align: top; text-align: center;">
                        - <?php echo htmlspecialchars($companyName); ?> CMFP(deux copies).
                    </td>
                </tr>
            </table>
        </body>
        </html>
        <?php
        return ob_get_clean();
        }
        private function getImagePath(string $imageName): string
        {
            $projectDir = dirname(__DIR__, 2);
            $imagePath = $projectDir . '/public/images/' . $imageName;
            
            if (file_exists($imagePath)) {
                return 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));
            }
            
            return '';
        }
}