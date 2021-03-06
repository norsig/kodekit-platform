<?
/**
 * Kodekit Platform - http://www.timble.net/kodekit
 *
 * @copyright	Copyright (C) 2011 - 2016 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		MPL v2.0 <https://www.mozilla.org/en-US/MPL/2.0>
 * @link		https://github.com/timble/kodekit-platform for the canonical source repository
 */
?>

<?= helper('behavior.kodekit'); ?>
<?= helper('behavior.validator') ?>

<ktml:script src="assets://users/js/users.js" />

<script>
    window.addEvent('domready', function() {
        ComUsers.Form.addValidators(['passwordLength','passwordVerify']);
    });
</script>

<ktml:block prepend="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:block>

<form action="" method="post" id="user-form" class="-koowa-form">
    <input type="hidden" name="enabled" value="<?= object('user')->getId() == $user->id ? 1 : 0 ?>" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" id="name" name="name" value="<?= $user->name ?>" placeholder="<?= translate('Name') ?>" />
        </div>

        <div class="scrollable">
            <fieldset>
                <legend><?= translate('General') ?></legend>
                <div>
                    <label for="email"><?= translate('E-Mail') ?></label>
                    <div>
                        <input class="required validate-email" type="email" id="email" name="email" value="<?= $user->email ?>" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?= translate('Password') ?></legend>
                <div>
                    <label for="password"><?= translate('Password') ?></label>
                    <div>
                        <input class="passwordLength:6" id="password" type="password" name="password" maxlength="100" />
                        <?= helper('com:users.form.password');?>
                    </div>
                </div>
                <div>
                    <label for="password_verify"><?= translate('Verify Password') ?></label>
                    <div>
                        <input class="passwordVerify matchInput:'password' matchName:'password'" type="password" id="password_verify" name="password_verify" maxlength="100" />
                    </div>
                </div>
                <? if (!$user->isNew()): ?>
                <div>
                    <div>
                        <label class="checkbox" for="password_reset">
                            <input type="checkbox" id="password_reset" name="password_reset" />
                            <?= translate('Require a password reset for the next sign in') ?>
                        </label>
                    </div>
                </div>
                <? endif; ?>
            </fieldset>
            <fieldset>
                <legend><?= translate('Locale') ?></legend>
                <div>
                    <label for="parameters[timezone]"><?= translate('Time Zone') ?></label>
                    <div>
                        <?= helper('listbox.timezones', array(
                            'name'     => 'parameters[timezone]',
                            'selected' => $user->getParameters()->timezone,
                            'deselect' => true,
                            'attribs'  => array('class' => 'select-timezone')
                        )) ?>
                    </div>
                </div>
                <div>
                    <label for="parameters[language]"><?= translate('Language') ?></label>
                    <div>
                        <?= helper('listbox.languages', array(
                            'url'      => route(),
                            'name'     => 'parameters[language]',
                            'selected' => $user->getParameters()->language,
                            'deselect' => true,
                            'attribs'  => array('class' => 'select-language')
                        )) ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>