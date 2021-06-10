<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
	public function count() {
		$query = $this->createQueryBuilder('e')->select('count(e)')->getQuery();
		return $query->getSingleScalarResult();
	}
	public function Searchs() {
		$query = $this->createQueryBuilder('e')
		              ->select('sum(e.search)')
		              ->getQuery();
		return $this->getNumbers($query->getSingleScalarResult());
	}
	public function getNumbers($value) {
		if ($value < 1000) {
			return $value . '';
		} else {
			$value = $value / 1000;
			$units = ['K', 'M', 'B', 'T'];
			foreach ($units as $unit) {
				if (round($value, 2) >= 1000) {
					$value = $value / 1000;
				} else {
					break;
				}
			}
			return round($value, 2) . ' ' . $unit;
		}
	}
}