UPDATE `emprunts` SET `nom`=(SELECT `nom` FROM `clients` WHERE `trigramme`='aaa') WHERE `trigramme`='aaa'
UPDATE `emprunts` SET `prenom`=(SELECT `prenom` FROM `clients` WHERE `trigramme`='aaa') WHERE `trigramme`='aaa'
