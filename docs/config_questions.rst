.. _config_questions:

Reset by questions
==================


How it works?
-------------

First, the user should choose a question and register an answer. This
answer will be stored in an attribute of its LDAP entry with this
syntax:

::

   {questionid}answer

.. warning:: You should configure your LDAP directory to protect this
  data, to be only accessed by Self Service Password. See also in this
  page how to encrypt values into LDAP directory.

.. warning:: The data will be written by the user or by the manager,
  depending on ``$who_change_password`` parameter.

Then, the user can reset its password by entering its answer and setting
a new password.

Activation
----------

You can enable or disable this feature with ``$use_questions``:

.. code-block:: php

   $use_questions = true;

Multiple answers
----------------

By default, a user can only register an answer to one question. You can
allow users to register an answer to more than one question with this
parameter:

.. code-block:: php

   $multiple_answers = true;

Then the user can use any valid answer to reset its password.

You can also configure how many questions are displayed in the form.
If you want to require 2 answers to 2 different questions, configure ``$questions_count``:

.. code-block:: php

   $questions_count = 2;

Populate questions
------------------

This feature allows users to first submit an empty form with just their login.
The form will be displayed again with questions already registered for this user.
As this lowers the security, this is disabled by defaut.
Configure ``$question_populate_enable`` to enable it:

.. code-block:: php

   $question_populate_enable = true;

Attribute and object class
--------------------------

Set the attribute in which the answer will be stored:

.. code-block:: php

   $answer_attribute = "info";

.. warning:: The attribute name must be in lower case, this is required
  by php-ldap API.

If the above attribute is not in a standard user object class, configure
the object class to use with this attribute:

.. code-block:: php

   $answer_objectClass = "extensibleObject";

.. tip:: The object class will be added to the entry only if it is not
  already present.

If you enabled multiple answers, you can choose if they will be stored as multiple values
of the attribute, or stored in a single value:

.. code-block:: php

   $multiple_answers_one_str = true;

On Active Directory, extensibleObject is not known. You can use for example:

.. code-block:: php

   $answer_attribute = "comment";
   $answer_objectClass = "user";

Crypt answers
-------------

Before 1.3 release, answers could not be encrypted in LDAP directory. An
option can now be used to encrypt answers:

.. code-block:: php

   $crypt_answers = true;

You can set this option to ``false`` to keep the old behavior.

.. warning:: If you enable this option, you must change the default
  value of the `security keyphrase <config_general#security>`__

A script is provided to encrypt all clear text answers in LDAP
directory, to allow a swooth migration. Just run the script (it will use
your SSP LDAP settings to update values):

.. prompt:: bash #

   php /usr/share/self-service-password/scripts/encrypt_answers.php

Edit questions
--------------

Default questions are registered in lang files: ``lang/**codelang**.inc.php``.

To add a question, you can create a new value in the
``$messages['questions']`` array, directly in local configuration file
(``config.inc.local.php``):

.. code-block:: php

   $messages['questions']['ice'] = "What is your favorite ice cream flavor?";

Or better, to be able to translate it, create it in every customized lang file under
configuration directory:

* ``conf/`` directory for self-service-password archive
* ``/etc/self-service-password`` directory for rpm/deb packages

To disable the default questions form the main configuration file, set:

.. code-block:: php

   $questions_use_default = true;
