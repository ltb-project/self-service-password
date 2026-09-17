<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 Clement OUDOT
# Copyright (C) 2024 LTB-project.org
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
$messages['answer'] = "Réponse";
$messages['answerchanged'] = "Votre réponse a été enregistrée";
$messages['answermoderror'] = "Votre réponse n'a pas été enregistrée";
$messages['answernomatch'] = "Votre réponse est incorrecte";
$messages['answerrequired'] = "Pas de réponse donnée";
$messages['attributeschanged'] = "Vos informations ont bien été modifiées";
$messages['attributesmoderror'] = "La mise à jour de vos informations a échoué";
$messages['badcaptcha'] = "Le captcha n'a pas été entré correctement. Essayez à nouveau.";
$messages['badcredentials'] = "Identifiant ou mot de passe incorrect";
$messages['badquality'] = "La qualité du mot de passe est insuffisante";
$messages['captcha'] = "Captcha";
$messages['captcharequired'] = "Vous devez remplir le captcha.";
$messages['changecustompwdfieldhelp'] = "Pour changer votre mot de passe, vous devez rentrer votre mot de passe.";
$messages['changehelp'] = "Entrez votre ancien mot de passe et choisissez-en un nouveau.";
$messages['changehelpcustompwdfield'] = "Changez votre mot de passe pour ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Réinitialisez votre mot de passe en répondant à des questions</a>";
$messages['changehelpreset'] = "Mot de passe oublié ?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Réinitialisez votre mot de passe par SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Changez votre clé SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Réinitialisez votre mot de passe via un challenge par mail</a>";
$messages['changemessage'] = "Bonjour {login},\\n\\nVotre mot de passe a été changé.\\n\\nSi vous n'êtes pas à l'origine de cette demande, contactez votre administrateur immédiatement.";
$messages['changesshkeyhelp'] = "Entrez votre mot de passe et la nouvelle clé SSH.";
$messages['changesshkeymessage'] = "Bonjour {login}, \\n\\nVotre clé SSH a été changée. \\n\\nSi vous n'avez pas initié cette modification, veuillez contacter votre administrateur immédiatement.";
$messages['changesshkeysubject'] = "Votre clé SSH a été modifiée";
$messages['changesubject'] = "Votre mot de passe a été changé";
$messages['checkdatabeforesubmit'] = "Merci de vérifier les informations avant de valider le formulaire";
$messages['clickhere'] = "Cliquez ici";
$messages['confirmcustompassword'] = "confirmez votre mot de passe";
$messages['confirmpassword'] = "Confirmation du mot de passe";
$messages['confirmpasswordrequired'] = "Vous devez confirmer votre nouveau mot de passe";
$messages['diffminchars'] = "Votre nouveau mot de passe est trop similaire au précédant";
$messages['emptychangeform'] = "Changez votre mot de passe";
$messages['emptyresetbyquestionsform'] = "Réinitialisez votre mot de passe";
$messages['emptysendsmsform'] = "Obtenez un code de réinitialisation";
$messages['emptysendtokenform'] = "Recevez un lien pour changer votre mot de passe";
$messages['emptysetquestionsform'] = "Enregistrez votre réponse";
$messages['emptysshkeychangeform'] = "Changez votre clé SSH";
$messages['forbiddenchars'] = "Votre mot de passe contient des caractères interdits";
$messages['forbiddenldapfields'] = "Votre mot de passe contient des valeurs de votre entrée LDAP";
$messages['forbiddenwords'] = "Votre mot de passe contient des mots interdits";
$messages['getuser'] = "Trouver l'utilisateur";
$messages['hello'] = "Bonjour";
$messages['inhistory'] = "Le mot de passe est déjà présent dans votre historique";
$messages['insufficiententropy'] = "Entropie insuffisante pour le nouveau mot de passe";
$messages['invalidformtoken'] = "Jeton invalide";
$messages['invalidsshkey'] = "Cette clé SSH ne semble pas valide";
$messages['ldap_cn'] = "nom complet";
$messages['ldap_givenName'] = "prénom";
$messages['ldap_mail'] = "adresse email";
$messages['ldap_sn'] = "nom de famille";
$messages['ldaperror'] = "Erreur d'accès à l'annuaire";
$messages['login'] = "Identifiant";
$messages['loginrequired'] = "Vous devez indiquer votre identifiant";
$messages['mail'] = "Adresse mail";
$messages['mailnomatch'] = "L'adresse mail ne correspond pas à l'identifiant donné";
$messages['mailrequired'] = "Vous devez indiquer votre adresse mail";
$messages['menucustompwdfield'] = "Mot de passe pour ";
$messages['menuquestions'] = "Question";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "Clé SSH";
$messages['menutoken'] = "Mail";
$messages['mindigit'] = "Votre mot de passe n'a pas assez de chiffres";
$messages['minlower'] = "Votre mot de passe n'a pas assez de minuscules";
$messages['minspecial'] = "Votre mot de passe n'a pas assez de caractères spéciaux";
$messages['minupper'] = "Votre mot de passe n'a pas assez de majuscules";
$messages['missingformtoken'] = "Jeton manquant";
$messages['modificationcontactadministrator'] = "Si vous n'avez pas initié cette modification, veuillez contacter votre administrateur immédiatement.";
$messages['newcustompassword'] = "nouveau mot de passe pour ";
$messages['newpassword'] = "Nouveau mot de passe";
$messages['newpasswordrequired'] = "Vous devez indiquer votre nouveau mot de passe";
$messages['nocrypttokens'] = "Les jetons chiffrés sont requis pour la fonctionnalité de réinitialisation par SMS";
$messages['nokeyphrase'] = "Vous devez configurer keyphrase pour que le chiffrement fonctionne";
$messages['nomatch'] = "Les mots de passe ne correspondent pas";
$messages['nophpldap'] = "Vous devriez installer PHP LDAP pour utiliser cet outil";
$messages['nophpmbstring'] = "Vous devriez installer PHP mbstring";
$messages['nophpmhash'] = "Vous devriez installer PHP mhash pour utiliser le mode Samba";
$messages['nophpxml'] = "Vous devriez installer PHP XML pour utiliser cet outil";
$messages['noreseturl'] = "La fonction de réinitialisation par mail nécessite de configurer l'URL de réinitialisation";
$messages['notcomplex'] = "Votre mot de passe n'a pas assez de classes de caractères différentes.";
$messages['oldpassword'] = "Ancien mot de passe";
$messages['oldpasswordrequired'] = "Vous devez indiquer votre ancien mot de passe";
$messages['password'] = "Mot de passe";
$messages['passwordchanged'] = "Votre mot de passe a été changé";
$messages['passworderror'] = "Le mot de passe a été refusé";
$messages['passwordrequired'] = "Vous devez indiquer votre mot de passe";
$messages['phone'] = "Numéro de téléphone";
$messages['phpupgraderequired'] = "Use mise à jour de PHP est requise";
$messages['policy'] = "Votre mot de passe doit respecter les contraintes suivantes :";
$messages['policycomplex'] = "Nombre minimum de classes de caractères :";
$messages['policydifflogin'] = "Votre nouveau mot de passe ne doit pas être identique à votre identifiant";
$messages['policydiffminchars'] = "Nombre de nouveaux caractères unique :";
$messages['policyentropy'] = "Force du mot de passe";
$messages['policyforbiddenchars'] = "Caractères interdits :";
$messages['policyforbiddenldapfields'] = "Votre mot de passe ne doit pas contenir la valeur des attributs de votre entrée :";
$messages['policyforbiddenwords'] = "Votre mot de passe ne doit pas contenir ::";
$messages['policymaxlength'] = "Nombre maximum de caractères :";
$messages['policymindigit'] = "Nombre minimum de chiffres :";
$messages['policyminlength'] = "Nombre minimum de caractères :";
$messages['policyminlower'] = "Nombre minimum de minuscules :";
$messages['policyminspecial'] = "Nombre minimum de caractères spéciaux :";
$messages['policyminupper'] = "Nombre minimum de majuscules :";
$messages['policynoreuse'] = "Votre nouveau mot de passe ne doit pas être identique à l'ancien";
$messages['policynoreusecustompwdfield'] = "Votre nouveau mot de passe ne devrait pas être le même que le mot de passe de connexion";
$messages['policypwned'] = "Votre nouveau mot de passe ne doit pas être connu d'une base publique de mots de passe compromis";
$messages['policyspecialatends'] = "Votre nouveau mot de passe ne doit pas avoir son seul caractère spécial en première ou dernière position.";
$messages['pwned'] = "Votre nouveau mot de passe est compromis, vous devriez le changer partout où vous l'utilisez";
$messages['question'] = "Question";
$messages['questionrequired'] = "Pas de question sélectionnée";
$messages['questions']['birthday'] = "Quelle est votre date de naissance ?";
$messages['questions']['color'] = "Quelle est votre couleur préférée ?";
$messages['questionspopulatehint'] = "Entrez uniquement votre identifiant pour récupérer les questions que vous avez enregistrées.";
$messages['requestignore'] = "Si vous n'êtes pas à l'origine de cette demande, merci de l'ignorer.";
$messages['resetbyquestionshelp'] = "Choisissez une question et répondez-y pour réinitialiser pour votre mot de passe. Vous devez avoir au préalable <a href=\"?action=setquestions\">enregistré une réponse</a>.";
$messages['resetbysmshelp'] = "Le jeton envoyé par SMS vous permet de réinitialiser votre mot de passe. Pour recevoir un nouveau jeton, <a href=\"?action=sendsms\">cliquez ici</a>.";
$messages['resetbytokenhelp'] = "Le jeton envoyé par mail vous permet de réinitialiser votre mot de passe. Pour recevoir un nouveau jeton, <a href=\"?action=sendtoken\">cliquez ici</a>.";
$messages['resetmessage'] = "Bonjour {login},\\n\\nCliquez ici pour réinitialiser votre mot de passe :\\n{url}\\n\\nSi vous n'êtes pas à l'origine de cette demande, merci de l'ignorer.";
$messages['resetsubject'] = "Réinitialisation de votre mot de passe";
$messages['sameasaccountpassword'] = "Votre nouveau mot de passe est identique à votre mot de passe de connexion";
$messages['sameascustompwd'] = "Le nouveau mot de passe n'est pas unique par rapport aux autres champs de mots de passe personnalisés";
$messages['sameaslogin'] = "Votre mot de passe est identique à votre identifiant";
$messages['sameasold'] = "Votre mot de passe est identique au précédent";
$messages['sendsmshelp'] = "Entrez votre identifiant et votre numéro de téléphone pour obtenir votre code de confirmation. Entrez ensuite le code reçu par SMS.";
$messages['sendsmshelpnosms'] = "Entrez votre identifiant pour obtenir votre code de confirmation. Entrez ensuite le code reçu par SMS.";
$messages['sendsmshelpupdatephone'] = "Vous pouvez mettre à jour votre numéro de téléphone sur <a href=\"?action=setattributes\">cette page</a>.";
$messages['sendtokenhelp'] = "Entrez votre identifiant et votre adresse mail pour réinitialiser votre mot de passe. Cliquez ensuite sur le lien transmis par mail.";
$messages['sendtokenhelpnomail'] = "Entrez votre identifiant pour réinitialiser votre mot de passe. Cliquez ensuite sur le lien transmis par mail.";
$messages['sendtokenhelpupdatemail'] = "Vous pouvez mettre à jour votre adresse email sur <a href=\"?action=setattributes\">cette page</a>.";
$messages['setattributeshelp'] = "Vous pouvez mettre à jour les informations utilisées lors d'une demande de réinitialisation de mot de passe. Entrez votre identifiant et votre mot de passe puis saisissez vos nouvelles coordonnées.";
$messages['setquestionshelp'] = "Initialisez ou changez votre question/réponse pour la réinitialisation de votre mot de passe. Vous pourrez ensuite changer votre mot de passe <a href=\"?action=resetbyquestions\">ici</a>.";
$messages['sms'] = "Numéro SMS";
$messages['smscrypttokensrequired'] = "L'option crypt_tokens est nécessaire pour utiliser la fonction SMS.";
$messages['smsnomatch'] = "Le numéro de téléphone ne correspond pas à l'identifiant donné.";
$messages['smsnonumber'] = "Le numéro de mobile n'a pas été trouvé.";
$messages['smsnotsent'] = "Erreur lors de l'envoi du SMS";
$messages['smsrequired'] = "Vous devez indiquer votre numéro de téléphone.";
$messages['smsresetmessage'] = "Votre jeton est:";
$messages['smssent'] = "Le code de confirmation a été envoyé par SMS.";
$messages['smssent_ifexists'] = "Si ce compte existe, le code de confirmation a été envoyé par SMS.";
$messages['smstoken'] = "Code de confirmation";
$messages['smsuserfound'] = "Vérifiez que les informations ci-dessous sont correctes et cliquez sur Envoyer pour recevoir votre code de confirmation.";
$messages['specialatends'] = "Votre nouveau mot de passe a son unique caractère spécial en première ou dernière position";
$messages['sshkey'] = "Clé SSH";
$messages['sshkeychanged'] = "Votre clé SSH a été modifiée";
$messages['sshkeyerror'] = "La clé SSH a été refusée par l'annuaire  LDAP";
$messages['sshkeyrequired'] = "La clé SSH est requise";
$messages['submit'] = "Envoyer";
$messages['throttle'] = "Trop de tentatives en trop peu de temps. Réessayez un peu plus tard (si vous êtes bien humain)";
$messages['title'] = "Gestion du mot de passe";
$messages['tokenattempts'] = "Jeton invalide, essayez encore";
$messages['tokennotsent'] = "Erreur lors de l'envoi du mail de confirmation";
$messages['tokennotvalid'] = "Le jeton n'est pas valide";
$messages['tokenrequired'] = "Le jeton de réinitialisation est requis";
$messages['tokensent'] = "Un mail de confirmation a été envoyé";
$messages['tokensent_ifexists'] = "Si ce compte existe, un mail de confirmation lui a été envoyé";
$messages['toobig'] = "Votre mot de passe est trop long";
$messages['tooshort'] = "Votre mot de passe est trop court";
$messages['tooyoung'] = "Le mot de passe a été changé trop récemment";
$messages['toresetpassword'] = "pour réinitialiser votre mot de passe";
$messages['unknowncustompwdfield'] = "Le champ de mot de passe défini dans le lien ne peut être trouvé";
$messages['userfullname'] = "Nom complet";
$messages['username'] = "Identifiant";
