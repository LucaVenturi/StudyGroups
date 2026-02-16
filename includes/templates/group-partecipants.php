<?php

$groupId = $templateParams['group']['id'];
$creator = $templateParams['creator'];
$participants = $templateParams['partecipants'];
$isUserParticipant = false;

if (isUserLoggedIn()) {
    $user = getLoggedUser();
    $isUserParticipant = $dbHelper->isUserGroupParticipant($user['id'], $groupId);
    $isUserCreator = $dbHelper->isUserGroupCreator($user['id'], $groupId);
}

?>

<div class="card border-secondary mb-3 shadow-sm">
    <div class="card-header fw-bold">
        Partecipanti
    </div>
    <div class="card-body p-2">
        <!-- CREATORE DEL GRUPPO -->
        <div class="d-flex align-items-start mb-3">
            <img
                src="../assets/img/<?php echo $creator["foto_profilo"] ?>"
                alt=""
                width="50"
                height="50"
                class="rounded-circle object-fit-cover me-2" />
            <div>
                <div class="fw-semibold"><?php echo $creator["nome"] ?></div>
                <div class="small text-muted">Email: <?php echo $creator["email"] ?></div>
                <div class="small text-muted">Telegram: @<?php echo $creator["telegram"] ?></div>
            </div>
        </div>

        <hr />

        <!-- Partecipanti -->
        <?php if (isUserLoggedIn() && ($isUserParticipant || $isUserCreator)): ?>
            <?php foreach ($participants as $participant): ?>
                <div class="d-flex align-items-start mb-3">
                    <img
                        src="../assets/img/<?php echo $participant["foto_profilo"] ?>"
                        alt=""
                        width="50"
                        height="50"
                        class="rounded-circle object-fit-cover me-2" />
                    <div>
                        <div class="fw-semibold"><?php echo $participant["nome"] ?></div>
                        <div class="small text-muted">Email: <?php echo $participant["email"] ?></div>
                        <div class="small text-muted">Telegram: @<?php echo $participant["telegram"] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Messaggio che dice di loggarsi/unirsi al gruppo per vedere tutti i partecipanti. -->
            <div class="alert alert-light border-0 small text-muted mb-0">
                <?php if (!isUserLoggedIn()): ?>
                    <a href="login.php" class="fw-semibold">Accedi</a> per vedere gli altri partecipanti.
                <?php else: ?>
                    Unisciti al gruppo per vedere gli altri partecipanti e i loro contatti.
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- FOOTER CON IL PULSANTE -->
    <?php if (isUserLoggedIn()): ?>
        <?php if ($isUserParticipant || $isUserCreator): ?>
            <div class="card-footer text-center">
                <form
                    action="/StudyGroups/includes/api/group-actions/leave.php"
                    method="POST">
                    <input type="hidden" name="group_id" value="<?php echo $groupId ?>">
                    <button type="submit" class="btn btn-danger w-100">
                        Abbandona il gruppo
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="card-footer text-center">
                <form
                    action="/StudyGroups/includes/api/group-actions/join.php"
                    method="POST">
                    <input type="hidden" name="group_id" value="<?php echo $groupId ?>">
                    <button type="submit" class="btn btn-primary w-100">
                        Unisciti al gruppo
                    </button>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>