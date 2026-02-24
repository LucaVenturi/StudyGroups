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
            <?php if (!empty($creator["foto_profilo"])): ?>
                <img 
                    src="../assets/img/<?php echo htmlspecialchars($creator["foto_profilo"]) ?>"
                    alt=""
                    width="50" height="50"
                    class="rounded-circle object-fit-cover me-2" 
                />
            <?php else:
                $inizialiCreatore = strtoupper(substr($creator["nome"] ?? '', 0, 1) . substr($creator["cognome"] ?? '', 0, 1));
                if (empty(trim($inizialiCreatore))) $inizialiCreatore = '?';
            ?>
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2 border"
                     style="width: 50px; height: 50px;">
                    <?php echo $inizialiCreatore; ?>
                </div>
            <?php endif; ?>
            <div>
                <div class="fw-semibold"><?php echo htmlspecialchars($creator["nome"] ?? '') . ' ' . htmlspecialchars($creator["cognome"] ?? '') ?></div>
                <div class="small text-muted">Email: <?php echo htmlspecialchars($creator["email"] ?? '') ?></div>
                <div class="small text-muted">Telegram: @<?php echo htmlspecialchars($creator["telegram"] ?? '') ?></div>
            </div>
        </div>

        <hr />

        <!-- Partecipanti -->
        <?php if (isUserLoggedIn() && ($isUserParticipant || $isUserCreator)): ?>
            <?php foreach ($participants as $participant): ?>
                <div class="d-flex align-items-start mb-3">
                    <?php if (!empty($participant["foto_profilo"])): ?>
                        <img 
                            src="../assets/img/<?php echo htmlspecialchars($participant["foto_profilo"]) ?>"
                            alt=""
                            width="50" height="50"
                            class="rounded-circle object-fit-cover me-2"
                        />
                    <?php else:
                        $inizialiPart = strtoupper(substr($participant["nome"] ?? '', 0, 1) . substr($participant["cognome"] ?? '', 0, 1));
                        if (empty(trim($inizialiPart))) $inizialiPart = '?';
                    ?>
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2 border"
                             style="width: 50px; height: 50px;">
                            <?php echo $inizialiPart; ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <div class="fw-semibold"><?php echo htmlspecialchars($participant["nome"] ?? '') . ' ' . htmlspecialchars($participant["cognome"] ?? '') ?></div>
                        <div class="small text-muted">Email: <?php echo htmlspecialchars($participant["email"] ?? '') ?></div>
                        <div class="small text-muted">Telegram: @<?php echo htmlspecialchars($participant["telegram"] ?? '') ?></div>
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
        <?php if ($isUserParticipant && ! $isUserCreator): ?>
            <div class="card-footer text-center">
                <form
                    action="/StudyGroups/includes/actions/group-actions/leave.php"
                    method="POST">
                    <input type="hidden" name="group_id" value="<?php echo $groupId ?>" />
                    <button type="submit" class="btn btn-danger w-100">
                        Abbandona il gruppo
                    </button>
                </form>
            </div>
        <?php elseif (!$isUserParticipant && !$isUserCreator): ?>
            <div class="card-footer text-center">
                <form
                    action="/StudyGroups/includes/actions/group-actions/join.php"
                    method="POST">
                    <input type="hidden" name="group_id" value="<?php echo $groupId ?>" />
                    <button type="submit" class="btn btn-primary w-100">
                        Unisciti al gruppo
                    </button>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>