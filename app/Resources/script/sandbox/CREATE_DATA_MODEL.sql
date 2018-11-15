DROP TABLE node_type;

CREATE TABLE node_type (
  id INTEGER PRIMARY KEY,
  type text
);

DROP TABLE node;

CREATE TABLE node (
	id INTEGER PRIMARY KEY,
	name text,
	id_type integer,
	weight integer,
	formatted_name text,

	FOREIGN KEY (id_type) REFERENCES node_type(id)
);

-- // les types de noeuds (Nodes Types) : nt;ntid;'ntname'
--
-- nt;0;'n_generic'
-- nt;1;'n_term'
-- nt;2;'n_form'
-- nt;4;'n_pos'
-- nt;6;'n_flpot'
-- nt;8;'n_chunk'
-- nt;9;'n_question'
-- nt;10;'n_relation'
-- nt;12;'n_analogy'
-- nt;18;'n_data'
-- nt;36;'n_data_pot'
-- nt;444;'n_link'
-- nt;666;'n_AKI'
-- nt;777;'n_wikipedia'
-- nt;1002;'n_group'

INSERT INTO node_type (id, type) VALUES (0, 'n_generic');
INSERT INTO node_type (id, type) VALUES (1, 'n_term');
INSERT INTO node_type (id, type) VALUES (2, 'n_form');
INSERT INTO node_type (id, type) VALUES (4, 'n_pos');
INSERT INTO node_type (id, type) VALUES (6, 'n_flpot');
INSERT INTO node_type (id, type) VALUES (8, 'n_chunk');
INSERT INTO node_type (id, type) VALUES (9, 'n_question');
INSERT INTO node_type (id, type) VALUES (10, 'n_relation');
INSERT INTO node_type (id, type) VALUES (12, 'n_analogy');
INSERT INTO node_type (id, type) VALUES (18, 'n_data');
INSERT INTO node_type (id, type) VALUES (36, 'n_data_pot');
INSERT INTO node_type (id, type) VALUES (444, 'n_link');
INSERT INTO node_type (id, type) VALUES (666, 'n_AKI');
INSERT INTO node_type (id, type) VALUES (777, 'n_wikipedia');
INSERT INTO node_type (id, type) VALUES (1002, 'n_group');

DROP TABLE relation_type;

CREATE TABLE relation_type (
  id INTEGER PRIMARY KEY,
  name text,
  formatted_name text,
  description text
);

DROP TABLE relation;

CREATE TABLE relation (
  id INTEGER PRIMARY KEY,
  id_node integer,
  id_node2 integer,
  id_type integer,
  weight integer,

	FOREIGN KEY (id_type) REFERENCES relation_type(id)
);

-- INSERT INTO relation_type (id, name, formatted_name, description) VALUES (?, ?, ?, ?);
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (0, "r_associated", "idée associée", "Il est demandé d'énumérer les termes les plus étroitement associés au mot cible... Ce mot vous fait penser à quoi ?");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (1, "r_raff_sem", "raffinement sémantique", "Raffinement sémantique vers un usage particulier du terme source");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (3, "r_domain", "domaine", "Il est demandé de fournir des domaines relatifs au mot cible. Par exemple, pour 'corner', on pourra donner les domaines 'football' ou 'sport'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (4, "r_pos", "POS", "Partie du discours (Nom, Verbe, Adjectif, Adverbe, etc.)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (5, "r_syn", "synonyme", "Il est demandé d'énumérer les synonymes ou quasi-synonymes de ce terme.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (6, "r_isa", "générique", "Il est demandé d'énumérer les GENERIQUES/hyperonymes du terme. Par exemple, 'animal' et 'mammifère' sont des génériques de 'chat'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (8, "r_hypo", "spécifique", "Il est demandé d'énumérer des SPECIFIQUES/hyponymes du terme. Par exemple, 'mouche', 'abeille', 'guêpe' pour 'insecte'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (9, "r_has_part", "partie", "Il faut donner des PARTIES/constituants/éléments (a pour méronymes) du mot cible. Par exemple, 'voiture' a comme parties : 'porte', 'roue', 'moteur', ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (10, "r_holo", "tout", "Il est démandé d'énumérer des 'TOUT' (a pour holonymes)  de l'objet en question. Pour 'main', on aura 'bras', 'corps', 'personne', etc... Le tout est aussi l'ensemble comme 'classe' pour 'élève'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (11, "r_locution", "locution", "A partir d'un terme, il est demandé d'énumérer les locutions, expression ou mots composés en rapport avec ce terme. Par exemple, pour 'moulin', ou pourra avoir 'moulin à vent', 'moulin à eau', 'moulin à café'. Pour 'vendre', on pourra avoir 'vendre la peau de l'ours avant de l'avoir tué', 'vendre à perte', etc..");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (12, "r_flpot", " 	r_flpot", "(relation interne) potentiel de relation");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (13, "r_agent", "action>agent", "L'agent (qu'on appelle aussi le sujet) est l'entité qui effectue l'action, OU la subit pour des formes passives ou des verbes d'état. Par exemple, dans - Le chat mange la souris -, l'agent est le chat. Des agents typiques de 'courir' peuvent être 'sportif', 'enfant',...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (14, "r_patient", "action>patient", "Le patient (qu'on appelle aussi l'objet) est l'entité qui subit l'action. Par exemple dans - Le chat mange la souris -, le patient est la souris. Des patients typiques de manger peuvent être 'viande', 'légume', 'pain', ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (15, "r_lieu", "chose>lieu", "Il est demandé d'énumérer les LIEUX typiques où peut se trouver le terme/objet en question.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (16, "r_instr", "action>instrument", "L'instrument est l'objet avec lequel on fait l'action. Dans - Il mange sa salade avec une fourchette -, fourchette est l'instrument. Des instruments typiques de 'tuer' peuvent être 'arme', 'pistolet', 'poison', ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (17, "r_carac", "caractéristique", "Pour un terme donné, souvent un objet, il est demandé d'en énumérer les CARACtéristiques (adjectifs) possibles/typiques. Par exemple, 'liquide', 'froide', 'chaude', pour 'eau'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (18, "r_data", "r_data", "Informations diverses (plutôt d'ordre lexicales)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (19, "r_lemma", "r_lemma", "Le lemme (par exemple 'mangent a pour lemme  'manger' ; 'avions' a pour lemme 'avion' ou 'avoir').");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (20, "r_has_magn", "magn", "La magnification ou amplification, par exemple - forte fièvre - ou - fièvre de cheval - pour fièvre. Ou encore - amour fou - pour amour, - peur bleue - pour peur.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (21, "r_has_antimagn", "antimagn", "L'inverse de la magnification, par exemple - bruine - pour pluie.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (22, "r_family", "famille", "Des mots de la même famille lexicale sont demandés (dérivation morphologique, par exemple). Par exemple, pour 'lait' on pourrait mettre 'laitier', 'laitage', 'laiterie', etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (23, "r_carac-1", "caractéristique-1", "Quels sont les objets (des noms) possédant typiquement/possiblement la caractérisque suivante ? Par exemple, 'soleil', 'feu', pour 'chaud'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (24, "r_agent-1", "agent typique-1", "Que peut faire ce SUJET ? (par exemple chat => miauler, griffer, etc.)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (25, "r_instr-1", "instrument>action", "L'instrument est l'objet avec lequel on fait l'action. Dans - Il mange sa salade avec une fourchette -, fourchette est l'instrument. On demande ici, ce qu'on peut faire avec un instrument donné...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (26, "r_patient-1", "patient-1", "(inverse de r_patient) Que peut-on faire à cet OBJET. Pour 'pomme', on pourrait avoir 'manger', 'croquer', couper', 'éplucher',  etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (27, "r_domain-1", "domaine-1", "inverse de r_domain : à un domaine, on associe des termes");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (28, "r_lieu-1", "lieu>chose", "A partir d'un lieu, il est demandé d'énumérer ce qui peut typiquement s'y trouver.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (30, "r_lieu_action", "lieu>action", "A partir d'un lieu, énumérer les actions typiques possibles dans ce lieu.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (32, "r_sentiment", "sentiment", "Pour un terme donné, évoquer des mots liés à des SENTIMENTS ou des EMOTIONS que vous pourriez associer à ce terme. Par exemple, la joie, le plaisir, le dégoût, la peur, la haine, l'amour, l'indifférence, l'envie, avoir peur, horrible, etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (35, "r_meaning", "sens/signification", "Quels SENS/SIGNIFICATIONS pouvez vous donner au terme proposé. Il s'agira de termes évoquant chacun des sens possibles, par exemple : 'forces de l'ordre', 'contrat d'assurance', 'police typographique', ... pour 'police'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (36, "r_infopot", "information potentielle", "Information sémantique potentielle");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (41, "r_conseq", "conséquence", "B (que vous devez donner) est une CONSEQUENCE possible de A. A et B sont des verbes ou des noms.  Exemples : tomber -> se blesser ; faim -> voler ; allumer -> incendie ; négligence --> accident ; etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (42, "r_causatif", "cause", "B (que vous devez donner) est une CAUSE possible de A. A et B sont des verbes ou des noms.  Exemples : se blesser -> tomber ; vol -> pauvreté ; incendie -> négligence ; mort --> maladie ; etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (45, "r_chunk_sujet", "r_chunk_sujet", "(interne)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (46, "r_chunk_objet", "r_chunk_objet", "(interne)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (51, "r_mater>object", "matière>objet", "Quel est la ou les CHOSES qui sont composés de la MATIERE/SUBSTANCE qui suit (exemple 'bois' -> poutre, table, ...).");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (52, "r_successeur-time", "successeur", "Qu'est ce qui peut SUIVRE temporellement (par exemple Noêl -> jour de l'an, guerre -> paix, jour -> nuit,  pluie -> beau temps, repas -> sieste, etc) le terme suivant :");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (53, "r_make", "produit", "Que peut PRODUIRE le terme ? (par exemple abeille -> miel, usine -> voiture, agriculteur -> blé,  moteur -> gaz carbonique ...)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (58, "r_quantificateur", "quantificateur", "Quantificateur(s) typique(s) pour le terme,  indiquant une quantité. Par exemples, sucre -> grain, morceau - sel -> grain, pincée - herbe -> brin, touffe - ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (59, "r_masc", "équivalent masc", "L'équivalent masculin du terme : lionne --> lion.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (60, "r_fem", "équivalent fem", "L'équivalent féminin du terme : lion --> lionne.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (64, "r_has_instance", "a pour instance", "Une instance d'un 'type' est un individu particulier de ce type. Il s'agit d'une entité nommée (personne, lieu, organisation, etc) - par exemple, 'cheval' a pour instance possible 'Jolly Jumper', ou encore 'transatlantique' a pour instance possible 'Titanic'.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (66, "r_chunk_head", "r_chunk_head", NULL);
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (67, "r_similar", "similaire", "Similaire/ressemble à ; par exemple le congre est similaire à une anguille, ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (69, "r_item>set", "item>ensemble", "Quel est l'ENSEMBLE qui est composé de l'ELEMENT qui suit (par exemple, un essaim est composé d'aveilles)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (72, "r_syn_strict", "r_syn_strict", "Termes strictement substituables, pour des termes hors du domaine général, et pour la plupart des noms (exemple : endométriose intra-utérine --> adénomyose)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (73, "r_is_smaller_than", "est plus petit que", "Qu'est-ce qui est physiquement plus gros que... (la comparaison doit être pertinente)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (74, "r_is_bigger_than", "est plus gros que", "Qu'est-ce qui est physiquement moins gros que... (la comparaison doit être pertinente)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (102, "r_can_eat", "se nourrit de", "De quoi peut se nourir l'animal suivant ?");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (106, "r_color", "couleur", "A comme couleur(s)...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (107, "r_cible", "a comme cible", "Cible de la maladie : myxomatose => lapin, rougeole => enfant, ...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (109, "r_predecesseur-time", "prédécesseur", "Qu'est ce qui peut PRECEDER temporellement (par exemple -  inverse de successeur) le terme suivant :");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (115, "r_sentiment-1", "sentiment-1", "Pour un SENTIMENT ou EMOTION donné, il est demandé d’énumérer les termes que vous pourriez associer. Par exemple, pour 'joie', on aurait 'cadeau', 'naissance', 'bonne nouvelle', etc.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (126, "r_isa-incompatible", "r_isa-incompatible", "Relation d'incompatibilité pour les génériques. Si A r_isa-incompatible B alors X ne peut pas être à la fois A et B ou alors X est polysémique. Par exemple, poisson r_isa-incompatible oiseau. Colin est à la fois un oiseau et un poisson, donc colin est polysémique.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (128, "r_node2relnode", "r_node2relnode", "Relation entre un noeud (quelconque) et un noeud de relation (type = 10) - permet de rendre le graphe connexe même avec les annotations de relations");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (151, "r_descend_de", "descend de", "Descend de (évolution)...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (155, "r_make_use_of", "r_make_use_of", "Peut utiliser un objet ou produit (par exemple électricité pour frigo).");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (333, "r_translation", "r_translation", "Traduction vers une autre langue.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (444, "r_link", "r_link", "Lien vers une ressource externe (WordNet, RadLex, UMLS, Wikipedia, etc...)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (555, "r_cooccurrence", "r_cooccurrence", "co-occurences (non utilisée)");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (666, "r_aki", "r_aki", "(TOTAKI) equivalent pour TOTAKI de l'association libre");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (777, "r_wiki", "r_wiki", "Associations issues de wikipedia...");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (999, "r_inhib", "r_inhib", "relation d'inhibition, le terme inhibe les termes suivants... ce terme a tendance à exclure le terme associé.");
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (1002, "r_termgroup", "r_termgroup", NULL);
INSERT INTO relation_type (id, name, formatted_name, description) VALUES (2000, "r_raff_sem-1", "r_raff_sem-1", NULL);
