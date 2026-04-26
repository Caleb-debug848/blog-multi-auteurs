<?php
namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
{
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Post::truncate();
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $author = User::where('role', 'author')->first();

        $posts = [
            [
                'title'       => 'Vie chère au Cameroun : le panier de la ménagère de plus en plus lourd',
                'image'       => 'https://africapresse.com/wp-content/uploads/2024/02/agri20230823_NewsPic_shutterstock_1843289062_1200X675.jpg',
                'category_id' => 1,
                'tags'        => [1, 2],
                'body'        => "Dans les marchés de Yaoundé et Douala, la réalité est brutale : le prix des denrées alimentaires de base a grimpé de façon alarmante ces derniers mois. Le riz, l'huile de palme, le poisson, le plantain — autant de produits essentiels qui pèsent désormais très lourd dans le budget des ménages camerounais.

**Une hausse généralisée des prix**

Selon plusieurs ménagères interrogées au marché du Mfoundi à Yaoundé, le prix du sac de riz de 25 kg est passé de 12 000 à plus de 18 000 FCFA en l'espace de deux ans. L'huile de palme, autrefois accessible, se négocie aujourd'hui à des prix que beaucoup ne peuvent plus se permettre.

**Les causes d'une crise profonde**

Plusieurs facteurs expliquent cette flambée des prix : la dépréciation du franc CFA face aux grandes devises, la perturbation des chaînes d'approvisionnement mondiales depuis la pandémie de Covid-19, et la hausse des coûts de transport liée au prix du carburant. À cela s'ajoutent les intermédiaires qui gonflent artificiellement les prix entre le producteur et le consommateur final.

**Les ménages s'adaptent tant bien que mal**

Face à cette situation, les familles camerounaises ont dû revoir leurs habitudes alimentaires. Certains remplacent la viande par du poisson séché moins cher, d'autres réduisent le nombre de repas par jour. Les femmes, qui gèrent l'essentiel des dépenses du foyer, sont en première ligne de cette crise silencieuse.

**L'État interpellé**

Des organisations de la société civile appellent le gouvernement à prendre des mesures urgentes : subventionner les produits de première nécessité, lutter contre la spéculation, et soutenir la production locale. La question du pouvoir d'achat des Camerounais reste l'un des défis majeurs de ce début d'année 2026.",
            ],
            [
                'title'       => 'Agriculture au Cameroun : les paysans face aux défis climatiques et économiques',
                'image'       => 'https://africapresse.com/wp-content/uploads/2024/02/agri20230823_NewsPic_shutterstock_1843289062_1200X675.jpg',
                'category_id' => 1,
                'tags'        => [1, 3],
                'body'        => "Le secteur agricole camerounais, pilier de l'économie nationale, traverse une période particulièrement difficile. Entre dérèglement climatique, manque d'infrastructures et accès limité aux financements, les agriculteurs camerounais se retrouvent dans une situation précaire qui menace la sécurité alimentaire du pays.

**Le cacao et le café en première ligne**

Le Cameroun est l'un des grands producteurs mondiaux de cacao et de café. Pourtant, les planteurs de ces cultures d'exportation voient leurs revenus stagner, voire diminuer. Les maladies des plants, les pluies irrégulières et la vétusté des outils de production aggravent chaque année la situation.

**Des petits exploitants abandonnés**

La grande majorité des agriculteurs camerounais sont de petits exploitants qui cultivent moins de deux hectares. Sans accès au crédit agricole, sans assurance, et souvent sans formation technique adaptée, ils restent vulnérables aux moindres aléas climatiques ou économiques.

**Des initiatives prometteuses**

Malgré ces difficultés, certaines initiatives redonnent espoir. Des coopératives agricoles émergent dans les régions de l'Ouest et du Littoral, permettant aux paysans de mutualiser leurs ressources et de mieux négocier les prix. Des ONG et des startups agritech proposent également des solutions numériques pour améliorer la gestion des exploitations.

**Un secteur à réformer d'urgence**

Les experts s'accordent à dire que le Cameroun doit investir massivement dans la modernisation de son agriculture : mécanisation, irrigation, formation des jeunes agriculteurs et développement des marchés locaux. C'est à ce prix que le pays pourra nourrir sa population croissante et réduire sa dépendance aux importations alimentaires.",
            ],
            [
                'title'       => 'Internet au Cameroun : connexion lente et coût élevé, le calvaire des utilisateurs',
                'image'       => 'https://www.newsducamer.com/wp-content/uploads/2024/02/photo-papier-internet-1er-papier.jpg',
                'category_id' => 2,
                'tags'        => [4, 5],
                'body'        => "Naviguer sur Internet au Cameroun relève souvent du parcours du combattant. Entre les coupures intempestives, les débits insuffisants et des tarifs parmi les plus élevés d'Afrique subsaharienne, les utilisateurs camerounais paient cher pour un service de qualité médiocre.

**Des chiffres qui parlent d'eux-mêmes**

Selon les données de l'Autorité de Régulation des Télécommunications (ART), le taux de pénétration d'Internet au Cameroun reste inférieur à 40% de la population. La vitesse moyenne de connexion mobile tourne autour de 15 Mbps, bien en deçà de la moyenne africaine. Dans les zones rurales, la situation est encore plus alarmante, avec des millions de citoyens totalement déconnectés.

**Le coût, principal obstacle**

Un forfait de données de 10 Go coûte en moyenne 5 000 FCFA au Cameroun, soit l'équivalent de plusieurs jours de salaire pour de nombreux travailleurs. À titre de comparaison, en Côte d'Ivoire ou au Sénégal, le même volume de données est disponible à des prix nettement inférieurs.

**Les opérateurs sous pression**

MTN Cameroun et Orange Cameroun, les deux principaux opérateurs, sont régulièrement critiqués pour la qualité de leur réseau. Malgré les investissements annoncés dans la fibre optique et l'extension de la couverture 4G, de nombreuses zones urbaines restent mal desservies.

**L'enjeu du numérique pour le développement**

Dans un monde de plus en plus connecté, l'accès à Internet n'est plus un luxe mais une nécessité. Education, santé, commerce, administration — tous ces secteurs dépendent désormais d'une connexion fiable et abordable. Le Cameroun doit impérativement régler ce problème pour ne pas rater le train de la transformation numérique.",
            ],
            [
                'title'       => 'Téléphones importés au Cameroun : le gouvernement annonce le dédouanement obligatoire',
                'image'       => 'https://www.digitalbusiness.africa/wp-content/uploads/2019/12/smartphone-1.png',
                'category_id' => 2,
                'tags'        => [4, 6],
                'body'        => "Une mesure qui fait grand bruit : le gouvernement camerounais a annoncé que tout téléphone importé sur le territoire national devra désormais être obligatoirement dédouané. Les appareils non conformes seront purement et simplement bloqués sur les réseaux des opérateurs téléphoniques.

**En quoi consiste cette mesure ?**

Concrètement, chaque téléphone possède un identifiant unique appelé IMEI. Le gouvernement, via l'ART, a mis en place un système permettant de vérifier si cet IMEI correspond à un appareil régulièrement dédouané. Tout téléphone dont l'IMEI n'est pas enregistré dans la base de données officielle sera bloqué et ne pourra plus accéder aux réseaux mobiles camerounais.

**Pourquoi cette décision ?**

L'objectif affiché par les autorités est double : d'une part, lutter contre le commerce illicite de téléphones volés ou contrefaits, et d'autre part, augmenter les recettes douanières de l'État. En effet, une large partie des smartphones qui circulent au Cameroun entrent sur le territoire sans passer par les canaux officiels.

**La grogne des commerçants et des consommateurs**

Cette mesure ne fait pas l'unanimité. De nombreux commerçants du marché Mboppi à Douala et du marché Central à Yaoundé s'inquiètent pour leur activité. Quant aux consommateurs, beaucoup se demandent comment régulariser leur situation, surtout ceux qui ont acheté un téléphone à l'étranger ou reçu un appareil en cadeau de la diaspora.

**Comment régulariser son téléphone ?**

Les autorités ont mis en place une procédure de régularisation permettant aux propriétaires d'appareils non dédouanés de se mettre en conformité moyennant le paiement des droits de douane. Les détails de cette procédure sont disponibles auprès des services des douanes camerounaises et sur le site de l'ART.",
            ],
            [
                'title'       => 'Chômage des jeunes au Cameroun : une bombe sociale qui gronde',
                'image'       => 'https://files.cdn-files-a.com/uploads/6749484/2000_63615bb8f1408.png',
                'category_id' => 1,
                'tags'        => [1, 7],
                'body'        => "Le chômage des jeunes au Cameroun atteint des proportions inquiétantes. Chaque année, des dizaines de milliers de diplômés sortent des universités et grandes écoles du pays sans trouver d'emploi correspondant à leur formation. Une situation explosive qui alimente l'exode vers l'Europe et nourrit un sentiment profond de désespoir.

**Des chiffres alarmants**

Selon les estimations du Bureau International du Travail (BIT), le taux de chômage des jeunes de 15 à 35 ans au Cameroun dépasse les 35% dans les grandes villes. Dans les zones rurales, le sous-emploi est encore plus répandu, avec une grande partie de la jeunesse condamnée à des activités précaires et mal rémunérées.

**Le paradoxe du diplôme**

De nombreux jeunes Camerounais ont fait des sacrifices immenses pour obtenir leurs diplômes, souvent au prix de plusieurs années d'études difficiles et coûteuses. Mais une fois leurs parchemins en main, ils se heurtent à un marché du travail saturé et à un secteur privé trop étroit pour les absorber.

**La fuite des cerveaux, une hémorragie silencieuse**

Face à ces perspectives sombres, de plus en plus de jeunes Camerounais font le choix de l'émigration. Le Canada, la France, l'Allemagne et les pays du Golfe sont les destinations privilégiées. Cette fuite des cerveaux prive le Cameroun de ses forces vives au moment même où le pays en aurait le plus besoin.

**Des solutions à explorer**

Des experts préconisent plusieurs pistes : renforcer l'enseignement technique et professionnel, encourager l'entrepreneuriat jeune via des fonds d'amorçage, et créer des passerelles entre les universités et le secteur privé. Le gouvernement a lancé plusieurs programmes en ce sens, mais leur impact reste limité face à l'ampleur du défi.",
            ],
            [
                'title'       => 'Coupures d\'électricité au Cameroun : ENEO pointé du doigt',
                'image'       => 'https://s.rfi.fr/media/display/8c04d73c-0d44-11ea-8e3a-005056bfe576/w:1024/p:16x9/cameroon_2_0.JPG',
                'category_id' => 1,
                'tags'        => [1, 8],
                'body'        => "Les délestages électriques sont devenus le quotidien de millions de Camerounais. Que ce soit à Douala, Yaoundé ou dans les villes secondaires, les coupures de courant s'éternisent parfois pendant des heures, voire des jours entiers, paralysant les activités économiques et épuisant les ménages.

**ENEO dans le viseur**

Energy of Cameroon (ENEO), concessionnaire du service public de l'électricité, est la principale cible des critiques. La société, dont le capital est détenu en partie par le groupe britannique Actis, est accusée de ne pas investir suffisamment dans la modernisation du réseau de distribution et de ne pas gérer efficacement la production disponible.

**Un réseau vieillissant**

Une grande partie des infrastructures électriques camerounaises date de l'époque coloniale ou des premières décennies après l'indépendance. Les transformateurs défectueux, les lignes haute tension vétustes et les pertes techniques élevées contribuent à l'inefficacité du système.

**Les conséquences économiques désastreuses**

Les petites et moyennes entreprises sont les premières victimes de ces coupures à répétition. Les artisans, les restaurants, les cybercafés et les commerces voient leur productivité chuter et leurs équipements électriques endommagés par les surtensions. Le coût économique de ces délestages est estimé à plusieurs milliards de FCFA par an.

**Des alternatives qui se développent**

Face à la défaillance du réseau public, de nombreux ménages et entreprises se tournent vers les groupes électrogènes et, de plus en plus, vers les panneaux solaires. Cette énergie alternative reste cependant coûteuse à l'investissement et inaccessible pour les foyers les plus modestes.",
            ],
            [
                'title'       => 'Transport en commun à Douala : l\'enfer quotidien des usagers',
                'image'       => 'https://www.investiraucameroun.com/images/news/2002-23120-mobilite-urbaine-comment-l-ia-a-permis-d-economiser-plus-de-136-000-heures-aux-usagers-a-douala-et-yaounde-en-2025_L.jpg',
                'category_id' => 1,
                'tags'        => [1, 9],
                'body'        => "Douala, capitale économique du Cameroun et ville de plus de quatre millions d'habitants, suffoque sous le poids de ses embouteillages. Chaque matin et chaque soir, des centaines de milliers de travailleurs vivent un véritable calvaire pour rejoindre leur lieu de travail ou rentrer chez eux.

**Une ville pensée pour la voiture individuelle**

L'urbanisation rapide et non planifiée de Douala a engendré une ville dont la configuration ne favorise pas les transports en commun efficaces. Les grandes artères sont régulièrement saturées, et les quartiers périphériques comme Logbaba, Bonabéri ou PK14 sont souvent enclavés.

**Les motos-taxis, solution de fortune**

En l'absence d'un système de transport en commun structuré, les motos-taxis — communément appelés «bendskin» — sont devenus le mode de déplacement dominant. Pratiques mais dangereux, ils représentent une source d'accidents importante et contribuent à la congestion et à la pollution atmosphérique de la ville.

**Le projet de Bus Rapid Transit en attente**

Depuis plusieurs années, un projet de Bus Rapid Transit (BRT) pour Douala est sur la table. Ce système de bus à haut niveau de service, qui a fait ses preuves dans de nombreuses métropoles africaines comme Lagos et Dar es Salaam, pourrait révolutionner la mobilité à Douala. Mais le projet peine à se concrétiser, faute de financement et de volonté politique suffisante.

**L'intelligence artificielle au secours de la mobilité**

Une initiative récente mérite d'être saluée : grâce à des outils d'optimisation basés sur l'intelligence artificielle, il a été possible d'économiser plus de 136 000 heures de trajet aux usagers de Douala et Yaoundé en 2025. Une goutte d'eau face à l'ampleur du problème, mais un signe encourageant pour l'avenir.",
            ],
            [
                'title'       => 'Santé au Cameroun : les hôpitaux publics à bout de souffle',
                'image'       => 'https://s.rfi.fr/media/display/922f0862-22fa-11ec-990c-005056bfe576/w:1280/p:4x3/000_1PN7PH.jpg',
                'category_id' => 1,
                'tags'        => [1, 10],
                'body'        => "Le système de santé publique camerounais est en crise. Manque de médicaments, personnel soignant sous-payé et démotivé, équipements obsolètes, plateaux techniques insuffisants — les hôpitaux publics du pays peinent à assurer leurs missions de base, laissant des millions de patients dans une situation précaire.

**Des structures débordées**

L'Hôpital Central de Yaoundé, l'Hôpital Général de Douala ou encore l'Hôpital Laquintinie accueillent chaque jour des milliers de patients dans des conditions souvent difficiles. Les salles d'attente débordent, les lits manquent, et les délais de prise en charge s'allongent dangereusement.

**Le personnel soignant à bout**

Les médecins, infirmiers et sages-femmes qui ont choisi de rester dans le secteur public malgré des salaires insuffisants méritent respect et admiration. Mais leur dévouement a des limites : l'épuisement professionnel guette, et le phénomène de fuite vers le secteur privé ou vers l'étranger ne cesse de s'accélérer.

**La désertification médicale des zones rurales**

Si la situation est difficile dans les grandes villes, elle est carrément alarmante dans les zones rurales. Dans de nombreux villages, le centre de santé le plus proche est à plusieurs dizaines de kilomètres, et il manque souvent de médicaments essentiels et de personnel qualifié.

**Des réformes urgentes nécessaires**

Les experts de la santé publique appellent à une refonte profonde du système : augmentation du budget de la santé, revalorisation des salaires du personnel soignant, développement de la télémédecine pour désenclaver les zones rurales, et mise en place d'une couverture santé universelle effective. Le Cameroun a les ressources pour relever ce défi — il lui faut maintenant la volonté politique de le faire.",
            ],
            [
                'title'       => 'ChatGPT-5 : l\'intelligence artificielle qui bouleverse le monde du travail',
                'image'       => 'https://cdn8.futura-sciences.com/a1280/images/ChatGPT%20Image%20Nov%2013%2C%202025%2C%2003_15_24%20PM.jpg',
                'category_id' => 2,
                'tags'        => [4, 11],
                'body'        => "L'intelligence artificielle franchit un nouveau cap avec ChatGPT-5, la dernière version du célèbre assistant développé par OpenAI. Plus rapide, plus précis, plus capable de raisonnement complexe — ce nouvel outil redéfinit les frontières de ce que l'IA peut accomplir, et avec elle, transforme profondément le monde du travail à l'échelle mondiale.

**Des capacités sans précédent**

ChatGPT-5 est capable de mener des analyses approfondies, de rédiger des rapports complets, de coder des applications entières, de traduire avec une précision quasi-humaine, et même de gérer des projets complexes de manière autonome. Sa compréhension du contexte et sa capacité à maintenir des conversations longues et cohérentes ont atteint un niveau qui impressionne même les spécialistes.

**Quels métiers sont menacés ?**

Les secteurs les plus directement impactés sont ceux qui reposent sur le traitement de l'information : comptabilité, droit, journalisme, programmation, service client, traduction, analyse financière. Des tâches qui prenaient des heures peuvent désormais être accomplies en quelques secondes par l'IA.

**Une opportunité autant qu'une menace**

Cependant, de nombreux experts tempèrent les craintes. Pour eux, l'IA ne remplace pas les humains mais augmente leurs capacités. Les professionnels qui sauront maîtriser ces outils seront plus productifs et plus compétitifs. La clé réside dans la formation et l'adaptation.

**L'Afrique face au défi de l'IA**

Pour les pays africains, dont le Cameroun, l'IA représente à la fois un risque et une opportunité extraordinaire. Risque de voir leurs marchés du travail perturbés sans disposer des filets de sécurité sociale des pays développés. Mais aussi opportunité de sauter des étapes du développement en adoptant directement les technologies les plus avancées.",
            ],
            [
                'title'       => 'Les voitures électriques envahissent le marché mondial : et l\'Afrique dans tout ça ?',
                'image'       => 'https://ichelabamotor.com/wp-content/uploads/2024/11/Africa-ev-car-2.jpg',
                'category_id' => 2,
                'tags'        => [4, 12],
                'body'        => "La révolution des véhicules électriques est en marche. En Europe, en Asie et en Amérique du Nord, les ventes de voitures électriques battent des records d'année en année. Tesla, BYD, Volkswagen, Renault — tous les grands constructeurs ont basculé vers l'électrique. Mais pendant que le monde se convertit, où en est l'Afrique, et plus particulièrement le Cameroun ?

**Une adoption mondiale fulgurante**

En 2025, plus de 20 millions de véhicules électriques ont été vendus dans le monde, soit une croissance de 35% par rapport à l'année précédente. La Chine reste le marché le plus dynamique, suivie par l'Europe. Les prix des batteries ont chuté de 90% en dix ans, rendant les voitures électriques de plus en plus compétitives face aux véhicules thermiques.

**L'Afrique, un marché encore marginal**

Sur le continent africain, l'adoption des véhicules électriques reste embryonnaire. Les obstacles sont nombreux : manque d'infrastructures de recharge, coût d'achat encore élevé, accès limité au crédit, et paradoxalement, instabilité du réseau électrique dans de nombreux pays. Comment charger une voiture électrique quand ENEO coupe le courant plusieurs heures par jour ?

**Des initiatives africaines prometteuses**

Pourtant, des pionniers africains montrent la voie. Au Rwanda, le gouvernement a mis en place des incitations fiscales pour les véhicules électriques. En Afrique du Sud, des startups développent des solutions de mobilité électrique adaptées aux réalités locales. Au Kenya, des motos électriques remplacent progressivement les motos thermiques.

**Et le Cameroun ?**

Le Cameroun dispose d'un atout majeur : un important potentiel hydroélectrique qui pourrait fournir une énergie propre et abordable pour alimenter un parc de véhicules électriques. Mais pour l'heure, le pays n'a pas encore de politique claire en matière de mobilité électrique. Une opportunité à saisir avant qu'il ne soit trop tard.",
            ],
        ];

        foreach ($posts as $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);

            $post = Post::create([
                'title'       => $postData['title'],
                'slug'        => Str::slug($postData['title']),
                'body'        => $postData['body'],
                'image'       => $postData['image'],
                'status'      => 'published',
                'user_id'     => $author->id,
                'category_id' => $postData['category_id'],
            ]);

            $post->tags()->sync($tags);
        }
    }
}