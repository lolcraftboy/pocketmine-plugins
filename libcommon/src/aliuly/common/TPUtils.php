<?php
use pocketmine\Player;
use pocketmine\level\Position;
use pocketmine\math\Vector3;

/**
 * Telepoert Utilities
 */
abstract class TPUtils {
	/**
	 * Teleport a player near a location
	 * @param Player $player - player to be teleported
	 * @param Position $target - location to teleport nearby
	 * @param int $rand - how far to randomize positions
	 * @param int|null $dist - if not null it will make sure that new location is upto $dist
	 * @return bool - true on success, false on failure
	 */
	static public function tpNearBy(Player $player,Position $target,$rand = 3,$dist = null) {
    $mv = new Vector3($target->getX()+mt_rand(-$rand,$rand),
                      $target->getY(),
                      $target->getZ()+mt_rand(-$rand,$rand));
		$pos = $target->getLevel()->getSafeSpawn($mv);
		if ($dist !== null) {
			$newdist = $pos->distance($target);
			if ($newdist > $dist) return false;// Will not get close enough!
		}
    $player->teleport($pos);
		return true;
  }
}
