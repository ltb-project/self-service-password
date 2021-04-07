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
# Greek
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Απαιτείται η εγκατάσταση του πρόσθετου PHP LDAP για τη λειτουργία αυτής της εφαρμογής";
$messages['nophpmhash'] = "Απαιτείται η εγκατάσταση του πρόσθετου PHP mhash για τη χρήση Samba";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Αδυναμία πρόσβασης στην υπηρεσία καταλόγου";
$messages['loginrequired'] = "Απαιτείται η καταχώρηση του ονόματος χρήστη";
$messages['oldpasswordrequired'] = "Απαιτείται η καταχώρηση του ισχύοντος κωδικού σας";
$messages['newpasswordrequired'] = "Απαιτείται η καταχώρηση του νέου κωδικού σας";
$messages['confirmpasswordrequired'] = "Απαιτείται η επιβεβαίωση του νέου σας κωδικού";
$messages['passwordchanged'] = "Ο κωδικός σας άλλαξε";
$messages['nomatch'] = "Δεν καταχωρήσατε δύο φορές τον ίδιο νέο κωδικό";
$messages['badcredentials'] = "Το όνομα χρήστη ή ο κωδικός είναι λάθος";
$messages['passworderror'] = "Ο κωδικός δεν έγινε δεκτός από την υπηρεσία καταλόγου";
$messages['title'] = "Αλλαγή/Ανάκτηση Κωδικού";
$messages['login'] = "Όνομα χρήστη";
$messages['oldpassword'] = "Ισχύων κωδικός";
$messages['newpassword'] = "Νέος κωδικός";
$messages['confirmpassword'] = "Επιβεβαίωση";
$messages['submit'] = "Αποστολή";
$messages['getuser'] = "Εύρεση χρήστη";
$messages['tooshort'] = "Ο κωδικός έχει λίγους χαρακτήρες";
$messages['toobig'] = "Ο κωδικός έχει πολλούς χαρακτήρες";
$messages['minlower'] = "Ο κωδικός δεν έχει αρκετούς πεζούς χαρακτήρες";
$messages['minupper'] = "Ο κωδικός δεν έχει αρκετούς κεφαλαίους χαρακτήρες";
$messages['mindigit'] = "Ο κωδικός δεν έχει αρκετούς αριθμούς";
$messages['minspecial'] = "Ο κωδικός δεν έχει αρκετούς ειδικούς χαρακτήρες";
$messages['sameasold'] = "Ο νέος κωδικός που επιλέξατε είναι ίδιος με τον ισχύοντα";
$messages['policy'] = "Ο κωδικός σας πρέπει να πληροί τις παρακάτω προδιαγραφές:";
$messages['policyminlength'] = "Ελάχιστο μήκος:";
$messages['policymaxlength'] = "Μέγιστο μήκος:";
$messages['policyminlower'] = "Ελάχιστο πλήθος πεζών χαρακτήρων:";
$messages['policyminupper'] = "Ελάχιστο πλήθος κεφαλαίων χαρακτήρων:";
$messages['policymindigit'] = "Ελάχιστο πλήθος αριθμητικών ψηφίων:";
$messages['policyminspecial'] = "Ελάχιστο πλήθος ειδικών χαρακτήρων:";
$messages['forbiddenchars'] = "Ο κωδικός σας περιέχει απαγορευμένους χαρακτήρες";
$messages['policyforbiddenchars'] = "Απαγορευμένοι χαρακτήρες:";
$messages['policynoreuse'] = "Ο νέος κωδικός σας δεν πρέπει να είναι ίδιος με τον ισχύοντα";
$messages['questions']['birthday'] = "Πότε είναι τα γενέθλιά σας;";
$messages['questions']['color'] = "Ποιό είναι το αγαπημένο σας χρώμα;";
$messages['password'] = "Κωδικός";
$messages['question'] = "Ερώτηση";
$messages['answer'] = "Απάντηση";
$messages['setquestionshelp'] = "Ορίστε ή αλλάξτε την ερώτηση/απάντηση αλλαγής κωδικού. Έπειτα, θα μπορείτε να αλλάξετε τον κωδικό σας <a href=\"?action=resetbyquestions\">εδώ</a>.";
$messages['answerrequired'] = "Δεν δόθηκε απάντηση";
$messages['questionrequired'] = "Δεν επιλέχθηκε ερώτηση";
$messages['passwordrequired'] = "Απαιτείται ο κωδικός σας";
$messages['answermoderror'] = "Η απάντησή σας δεν καταχωρήθηκε";
$messages['answerchanged'] = "Η απάντησή σας καταχωρήθηκε";
$messages['answernomatch'] = "Η απάντησή σας είναι λάθος";
$messages['resetbyquestionshelp'] = "Επιλέξετε μια ερώτηση και απαντήστε τη για να ξαναορίσετε τον κωδικό σας. Απαιτείται να έχετε ήδη <a href=\"?action=setquestions\">καταχωρήσει μια απάντηση</a>.";
$messages['changehelp'] = "Καταχωρήστε τον ισχύοντα κωδικό σας και επιλέξτε ένα νέο.";
$messages['changehelpreset'] = "Ξεχάσατε τον κωδικό σας;";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Αλλάξτε τον κωδικό σας απαντώντας σε ερωτήσεις</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Αποστολή email με σύνδεσμο αλλαγής κωδικού</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Αλλάξτε τον κωδικό σας μέσω SMS</a>";
$messages['resetmessage'] = "Γειά σας {login},\n\nΕπιλέξτε αυτό το σύνδεσμο για να αλλάξετε τον κωδικό σας:\n{url}\n\nΑν δεν έχετε ζητήσει αλλαγή κωδικού, παρακαλούμε να αγνοήσετε αυτό το μήνυμα.";
$messages['resetsubject'] = "Αλλάξτε τον κωδικό σας";
$messages['sendtokenhelp'] = "Καταχωρήστε το όνομα χρήστη και τη διεύθυνση ηλεκτρονικού ταχυδρομείου για να αλλάξετε τον κωδικό σας. Όταν λάβετε το email, επιλέξτε το σύνδεσμο που περιέχει για να ολοκληρώσετε την αλλαγή κωδικού.";
$messages['sendtokenhelpnomail'] = "Καταχωρήστε το όνομα χρήστη για να αλλάξετε τον κωδικό σας. Όταν λάβετε το email, επιλέξτε το σύνδεσμο που περιέχει για να ολοκληρώσετε την αλλαγή κωδικού.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Απαιτείται η διεύθυνση ηλεκτρονικού ταχυδρομείου σας";
$messages['mailnomatch'] = "Η διεύθυνση ηλεκτρονικού ταχυδρομείου δεν αντιστοιχεί σε αυτό το όνομα χρήστη";
$messages['tokensent'] = "Στάλθηκε ηλεκτρονικό μήνυμα επιβεβαίωσης";
$messages['tokennotsent'] = "Λάθος στην αποστολή του ηλεκτρονικού μηνύματος επιβεβαίωσης";
$messages['tokenrequired'] = "Απαιτείται μοναδικό αναγνωριστικό";
$messages['tokennotvalid'] = "Το μοναδικό αναγνωριστικό δεν είναι έγκυρο";
$messages['resetbytokenhelp'] = "Ο σύνδεσμος που στάλθηκε μέσω email σας επιτρέπει να αλλάξετε τον κωδικό σας. Για να ζητήσετε νέο σύνδεσμο μέσω email, <a href=\"?action=sendtoken\">κλικ εδώ</a>.";
$messages['resetbysmshelp'] = "Ο σύνδεσμος που στάλθηκε μέσω sms σας επιτρέπει να αλλάξετε τον κωδικό σας. Για να ζητήσετε νέο σύνδεσμο μέσω sms, <a href=\"?action=sendsms\">κλικ εδώ</a>.";
$messages['changemessage'] = "Hello {login},\n\nΟ κωδικός σας άλλαξε.\n\nΑν δεν έχετε ζητήσει αλλαγή κωδικού, παρακαλούμε να επικοινωνήσετε αμέσως με το διαχειριστή σας.";
$messages['changesubject'] = "Ο κωδικός σας άλλαξε";
$messages['badcaptcha'] = "Το reCAPTCHA δεν καταχωρήθηκε σωστά. Δοκιμάστε πάλι.";
$messages['notcomplex'] = "Ο κωδικός σας δεν περιέχει αρκετά διαφορετικά είδη χαρακτήρων";
$messages['policycomplex'] = "Ελάχιστος αριθμός διαφορετικών ειδών χαρακτήρων:";
$messages['sms'] = "Αριθμός SMS";
$messages['smsresetmessage'] = "Το μοναδικό αναγνωριστικό αλλαγής του κωδικού σας είναι:";
$messages['sendsmshelp'] = "Καταχωρήστε το όνομα χρήστη για να λάβετε μοναδικό αναγνωριστικό αλλαγής κωδικού. Στη συνέχεια καταχωρήστε το μοναδικό αναγνωριστικό που λάβατε μέσω SMS.";
$messages['smssent'] = "Ένας κωδικός επιβεβαίωσης στάλθηκε μέσω SMS";
$messages['smsnotsent'] = "Λάθος στην αποστολή SMS";
$messages['smsnonumber'] = "Δεν υπάρχει αριθμός κινητού τηλεφώνου";
$messages['userfullname'] = "Ονοματεπώνυμο χρήστη";
$messages['username'] = "Όνομα χρήστη";
$messages['smscrypttokensrequired'] = "Δεν μπορείτε να χρησιμοποιήσετε την επαναφορά κωδικού μέσω SMS χωρίς τη ρύθμιση crypt_tokens";
$messages['smsuserfound'] = "Ελέγξτε ότι οι πληροφορίες χρήστη είναι σωστές και πατήστε \'Αποστολή\' για να λάβετε μοναδικό αναγνωριστικό μέσω SMS";
$messages['smstoken'] = "Μοναδικό αναγνωριστικό SMS";
$messages['nophpmbstring'] = "Απαιτείται η εγκατάσταση του πρόσθετου PHP mbstring";
$messages['menuquestions'] = "Ερώτηση";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Απαιτείται η εγκατάσταση του πρόσθετου PHP XML για τη χρήση αυτής της λειτουργίας";
$messages['tokenattempts'] = "Μοναδικό αναγνωριστικό μη έγκυρο, προσπαθήστε πάλι";
$messages['emptychangeform'] = "Αλλάξτε τον κωδικό σας";
$messages['emptysendtokenform'] = "Αποστολή συνδέσμου αλλαγής κωδικού μέσω Email";
$messages['emptyresetbyquestionsform'] = "Επαναφέρετε τον κωδικό σας";
$messages['emptysetquestionsform'] = "Ορίστε τις ερωτήσεις αλλαγής κωδικού";
$messages['emptysendsmsform'] = "Ζητήστε ένα μοναδικό αναγνωριστικό αλλαγής κωδικού";
$messages['sameaslogin'] = "Ο νέος σας κωδικός είναι ίδιος με το όνομα χρήστη";
$messages['policydifflogin'] = "Ο νέος σας κωδικός δεν πρέπει να είναι ίδιος με το όνομα χρήστη";
$messages['changesshkeysubject'] = "SSH κλειδί σας έχει αλλάξει";
$messages['changesshkeyhelp'] = "Εισάγετε τον κωδικό σας και νέο κλειδί SSH.";
$messages['changesshkeymessage'] = "Γεια σας {login}, \n\nΤα αρχεία SSH Key έχει αλλάξει. \n\nΑν δεν ξεκινήσατε αυτήν την αλλαγή, επικοινωνήστε με το διαχειριστή σας αμέσως.";
$messages['sshkeychanged'] = "SSH Key σας άλλαξε";
$messages['sshkeyerror'] = "SSH Key απορρίφθηκε από τον κατάλογο LDAP";
$messages['emptysshkeychangeform'] = "Αλλάξτε SSH Key σας";
$messages['sshkeyrequired'] = "SSH Key απαιτείται";
$messages['menusshkey'] = "SSH Key";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Αλλάξτε SSH Key σας</a>";
$messages['sshkey'] = "SSH Key";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
