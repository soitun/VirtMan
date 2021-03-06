<?php

namespace VirtMan\Command;

use VirtMan\Command\Command;
use VirtMan\Storage\Storage;

class CreateStorage extends Command {
  /**
   * Storage Object name
   *
   * @var string
   */
  private $storageName = "";

  /**
   * Initial directory where the storage image is located
   *
   * @var string
   */
  private $baseStorageLocation = "";

  /**
   * Full path to the storage image
   *
   * @var string
   */
  private $fullLocation = "";

  /**
   * Size for the storage image in MB.
   *
   * @var int
   */
  private $size = null;

  /**
   * Boolean for whether the storage image is active.
   *
   * @var boolean active
   */
   private $active = False;

   /**
    * Boolean for whether the storage image has been created.
    *
    * @var string
    */
   private $initialized = False;

   /**
    * The Storage Image Type
    *
    * @var string
    */
   private $type = "";

   /**
    * Created Storage Object
    *
    * @var Storage
    */
   private $storage = null;

   /**
    * Create Storage
    *
    * Command constructor
    *
    * @param string $storageName
    * @param int $size
    * @param string $type
    * @param Libvirt Resource $connection
    * @return None
    */
   public function __construct(string $storageName, int $size, string $type,
                              $connection)
   {
     $this->storageName = $storageName;
     $this->size = $size;
     $this->type = $type;
     $this->baseStorageLocation = config('virtman.storageLocation');
     $this->fullLocation = $this->baseStorageLocation .'/' . $storageName . $size . 'MB'. $type;
     parent::__construct("create_storage", $connection);
   }

   /**
    * Run
    *
    * Command Activation function
    *
    * @param None
    * @return Storage
    */
   public function run()
   {
     $this->storage = Storage::create([
       'name' => $this->storageName,
       'location' => $this->fullLocation,
       'type' => $this->type,
       'size' => $this->size,
       'active' => False,
       'initialized' => False
     ]);
     return $this->storage;
   }
}
