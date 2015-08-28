<?php
namespace Bolt\Storage;

use Bolt\Storage\Entity\Entity;
use Bolt\Storage\Entity;
use Silex\Application;

/**
 * Legacy bridge for Content object backward compatibility.
 *
 * @author Ross Riley <riley.ross@gmail.com>
 */
class ContentLegacyService
{
    use Entity\ContentRelationTrait;
    use Entity\ContentRouteTrait;
    use Entity\ContentSearchTrait;
    use Entity\ContentTaxonomyTrait;
    use Entity\ContentValuesTrait;

    protected $app;

    /**
     * Constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Initialise.
     *
     * @param Entity\Entity $entity
     */
    public function initialize(Entity\Entity $entity)
    {
        $this->setupContenttype($entity);
    }

    /**
     * Set the legacy ContentType object on the Entity.
     *
     * @param Entity\Entity $entity
     */
    public function setupContenttype(Entity\Entity $entity)
    {
        if (is_string($entity->getContenttype())) {
            $entity->contenttype = $this->app['storage']->getContenttype($entity->_contenttype);
        }
    }
}
