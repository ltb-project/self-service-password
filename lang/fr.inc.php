<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

#==============================================================================
# French
#==============================================================================
$messages['phpupgraderequired'] = "Use mise &agrave; jour de PHP est requise";
$messages['nophpldap'] = "Vous devriez installer PHP LDAP pour utiliser cet outil";
$messages['nophpmhash'] = "Vous devriez installer PHP mhash pour utiliser le mode Samba";
$messages['nokeyphrase'] = "Vous devez configurer keyphrase pour que le chiffrement fonctionne";
$messages['ldaperror'] = "Erreur d'acc&egrave;s &agrave; l'annuaire";
$messages['loginrequired'] = "Vous devez indiquer votre identifiant";
$messages['oldpasswordrequired'] = "Vous devez indiquer votre ancien mot de passe";
$messages['newpasswordrequired'] = "Vous devez indiquer votre nouveau mot de passe";
$messages['confirmpasswordrequired'] = "Vous devez confirmer votre nouveau mot de passe";
$messages['passwordchanged'] = "Votre mot de passe a &eacute;t&eacute; chang&eacute;";
$messages['nomatch'] = "Les mots de passe ne correspondent pas";
$messages['badcredentials'] = "Identifiant ou mot de passe incorrect";
$messages['passworderror'] = "Le mot de passe a &eacute;t&eacute; refus&eacute;";
$messages['title'] = "Gestion du mot de passe";
$messages['login'] = "Identifiant";
$messages['oldpassword'] = "Ancien mot de passe";
$messages['newpassword'] = "Nouveau mot de passe";
$messages['confirmpassword'] = "Confirmation";
$messages['submit'] = "Envoyer";
$messages['tooshort'] = "Votre mot de passe est trop court";
$messages['toobig'] = "Votre mot de passe est trop long";
$messages['minlower'] = "Votre mot de passe n'a pas assez de minuscules";
$messages['minupper'] = "Votre mot de passe n'a pas assez de majuscules";
$messages['mindigit'] = "Votre mot de passe n'a pas assez de chiffres";
$messages['minspecial'] = "Votre mot de passe n'a pas assez de caract&egrave;res sp&eacute;ciaux";
$messages['sameasold'] = "Votre mot de passe est identique au pr&eacute;c&eacute;dent";
$messages['policy'] = "Votre mot de passe doit respecter les contraintes suivantes&nbsp;:";
$messages['policyminlength'] = "Nombre minimum de caract&egrave;res&nbsp;:";
$messages['policymaxlength'] = "Nombre maximum de caract&egrave;res&nbsp;:";
$messages['policyminlower'] = "Nombre minimum de minuscules&nbsp;:";
$messages['policyminupper'] = "Nombre minimum de majuscules&nbsp;:";
$messages['policymindigit'] = "Nombre minimum de chiffres&nbsp;:";
$messages['policyminspecial'] = "Nombre minimum de caract&egrave;res sp&eacute;ciaux&nbsp;:";
$messages['forbiddenchars'] = "Votre mot de passe contient des caract&egrave;res interdits";
$messages['policyforbiddenchars'] = "Caract&egrave;res interdits&nbsp;:";
$messages['policynoreuse'] = "Votre nouveau mot de passe ne doit pas &ecirc;tre identique &agrave; l'ancien";
$messages['questions']['birthday'] = "Quelle est votre date de naissance ?";
$messages['questions']['color'] = "Quelle est votre couleur pr&eacute;f&eacute;r&eacute;e ?";
$messages['password'] = "Mot de passe";
$messages['question'] = "Question";
$messages['answer'] = "R&eacute;ponse";
$messages['setquestionshelp'] = "Initialisez ou changez votre question/r&eacute;ponse pour la r&eacute;initialisation de votre mot de passe. Vous pourrez ensuite changer votre mot de passe <a href=\"?action=resetbyquestions\">ici</a>.";
$messages['answerrequired'] = "Pas de r&eacute;ponse donn&eacute;e";
$messages['questionrequired'] = "Pas de question s&eacute;lectionn&eacute;e";
$messages['passwordrequired'] = "Vous devez indiquer votre mot de passe";
$messages['answermoderror'] = "Votre r&eacute;ponse n'a pas &eacute;t&eacute; enregistr&eacute;e";
$messages['answerchanged'] = "Votre r&eacute;ponse a &eacute;t&eacute; enregistr&eacute;e";
$messages['answernomatch'] = "Votre r&eacute;ponse est incorrecte";
$messages['resetbyquestionshelp'] = "Choisissez une question et r&eacute;pondez-y pour r&eacute;initialiser pour votre mot de passe. Vous devez avoir au pr&eacute;alable <a href=\"?action=setquestions\">enregistr&eacute; une r&eacute;ponse</a>.";
$messages['changehelp'] = "Entrez votre ancien mot de passe et choisissez-en un nouveau.";
$messages['changehelpreset'] = "Mot de passe oubli&eacute; ?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">R&eacute;initialisez votre mot de passe en r&eacute;pondant &agrave; des questions</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">R&eacute;initialisez votre mot de passe via un challenge par mail</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">R&eacute;initialisez votre mot de passe par SMS</a>";
$messages['resetmessage'] = "Bonjour {login},\n\nCliquez ici pour r&eacute;initialiser votre mot de passe :\n{url}\n\nSi vous n'&ecirc;tes pas &agrave; l'origine de cette demande, merci de l'ignorer.";
$messages['resetsubject'] = "R&eacute;initialisation de votre mot de passe";
$messages['sendtokenhelp'] = "Entrez votre identifiant et votre adresse mail pour r&eacute;initialiser votre mot de passe. Cliquez ensuite sur le lien transmis par mail.";
$messages['sendtokenhelpnomail'] = "Entrez votre identifiant pour r&eacute;initialiser votre mot de passe. Cliquez ensuite sur le lien transmis par mail.";
$messages['mail'] = "Adresse mail";
$messages['mailrequired'] = "Vous devez indiquer votre adresse mail";
$messages['mailnomatch'] = "L'adresse mail ne correspond pas &agrave; l'identifiant donn&eacute;";
$messages['tokensent'] = "Un mail de confirmation a &eacute;t&eacute; envoy&eacute;";
$messages['tokennotsent'] = "Erreur lors de l'envoi du mail de confirmation";
$messages['tokenrequired'] = "Le jeton de r&eacute;initialisation est requis";
$messages['tokennotvalid'] = "Le jeton n'est pas valide";
$messages['resetbytokenhelp'] = "Le jeton envoy&eacute; par mail vous permet de r&eacute;initialiser votre mot de passe. Pour recevoir un nouveau jeton, <a href=\"?action=sendtoken\">cliquez ici</a>.";
$messages['resetbysmshelp'] = "Le jeton envoy&eacute; par SMS vous permet de r&eacute;initialiser votre mot de passe. Pour recevoir un nouveau jeton, <a href=\"?action=sendsms\">cliquez ici</a>.";
$messages['changemessage'] = "Bonjour {login},\n\nVotre mot de passe a &eacute;t&eacute; chang&eacute;.\n\nSi vous n'&ecirc;tes pas &agrave; l'orgine de cette demande, contactez votre administrateur imm&eacute;diatement.";
$messages['changesubject'] = "Votre mot de passe a &eacute;t&eacute; chang&eacute;";
$messages['badcaptcha'] = "Le reCAPTCHA n'a pas &eacute;t&eacute; entr&eacute; correctement. Essayez &agrave; nouveau.";
$messages['notcomplex'] = "Votre mot de passe n'a pas assez de classes de caract&egrave;res diff&eacute;rentes.";
$messages['policycomplex'] = "Nombre minimun de classes de caract&egrave;res :";
$messages['sms'] = "Num&eacute;ro SMS";
$messages['smsresetmessage'] = "Votre jeton est:";
$messages['sendsmshelp'] = "Entrez votre identifiant pour obtenir votre code de confirmation. Entrez ensuite le code reçu par SMS.";
$messages['smssent'] = "Le code de confirmation a &eacute;t&eacute; envoy&eacute; par SMS.";
$messages['smsnotsent'] = "Erreur lors de l'envoi du SMS";
$messages['smsnonumber'] = "Le num&eacute;ro de mobile n'a pas &eacute;t&eacute; trouv&eacute;.";
$messages['userfullname'] = "Nom complet";
$messages['username'] = "Identifiant";
$messages['smscrypttokensrequired'] = "L'option crypt_tokens est n&eacute;cessaire pour utiliser la fonction SMS.";
$messages['smsuserfound'] = "V&eacute;rifiez que les informations ci-dessous sont correctes et cliquez sur Envoyer pour recevoir votre code de confirmation.";
$messages['smstoken'] = "Code de confirmation";
$messages['getuser'] = "Trouver l'utilisateur";
$messages['nophpmbstring'] = "Vous devriez installer PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Vous devriez installer PHP XML pour utiliser cet outil";
$messages['tokenattempts'] = "Jeton invalide, essayez encore";
$messages['emptychangeform'] = "Changez votre mot de passe";
$messages['emptysendtokenform'] = "Recevez un lien pour changer votre mot de passe";
$messages['emptyresetbyquestionsform'] = "R&eacute;initialisez votre mot de passe";
$messages['emptysetquestionsform'] = "Enregistrez votre r&eacute;ponse";
$messages['emptysendsmsform'] = "Obtenez un code de r&eacute;initialisation";
$messages['sameaslogin'] = "Votre mot de passe est identique &agrave; votre identifiant";
$messages['policydifflogin'] = "Votre nouveau mot de passe ne doit pas &ecirc;tre identique &agrave; votre identifiant";
$messages['changesshkeymessage'] = "Bonjour {login}, \n\nVotre cl&eacute; SSH a &eacute;t&eacute; chang&eacute;e. \n\nSi vous n'avez pas initi&eacute; cette modification, veuillez contacter votre administrateur imm&eacute;diatement.";
$messages['menusshkey'] = "Cl&eacute; SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Changez votre cl&eacute; SSH</a>";
$messages['sshkeychanged'] = "Votre cl&eacute; SSH a &eacute;t&eacute; modifi&eacute;e";
$messages['sshkeyrequired'] = "La cl&eacute; SSH est requise";
$messages['changesshkeysubject'] = "Votre cl&eacute; SSH a &eacute;t&eacute; modifi&eacute;e";
$messages['sshkey'] = "Cl&eacute; SSH";
$messages['emptysshkeychangeform'] = "Changez votre cl&eacute; SSH";
$messages['changesshkeyhelp'] = "Entrez votre mot de passe et la nouvelle cl&eacute; SSH.";
$messages['sshkeyerror'] = "La cl&eacute; SSH a &eacute;t&eacute; refus&eacute;e par l'annuaire  LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
$messages['specialatends'] = "Your new password has its only special character at the beginning or end";
$messages['policyspecialatends'] = "Your new password may not have its only special character at the beginning or end";
