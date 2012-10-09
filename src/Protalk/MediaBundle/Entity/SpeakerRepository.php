<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SpeakerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SpeakerRepository extends EntityRepository
{
	/**
     * Get all speakers and count of their entries
     *
     * @return Doctrine Collection
     */
    public function getAllSpeakers()
    {
		$qb = $this->getEntityManager()->createQueryBuilder();

		$qb->select('s.id', 's.name', 'COUNT(m.id) as mediaCount');
		$qb->from('\Protalk\MediaBundle\Entity\Speaker', 's');
		$qb->join('s.medias', 'm');
		$qb->where('m.isPublished = 1');
		$qb->groupBy('s.name');
		$qb->orderBy('s.name', 'ASC');

		$query = $qb->getQuery();
		return $query->execute();
    }
}
