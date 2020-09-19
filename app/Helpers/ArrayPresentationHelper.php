<?php
namespace App\Helpers;

class ArrayPresentationHelper
{
    private $keys;
    private $keysLength;
    private $dataBaseColumns= [
        'id',
        'group_id',
         'payment_description_id',
          'updated_at',
           'created_at',
            'member_id',
            'benefit_id',
        'expense_code_id',
        "is_welfare_member",
        "has_seen_doctor",
        "deleted_at",
        "orderID"
        ];
    public function __construct($record, $elementsToRemove=[])
    {
        if (!$record->all()->isEmpty()) {
        $lastRecord= $record->all()->pop();

            $this->keys = array_keys($lastRecord->toArray());
        } else {
            $this->keys = [];
        }
        if (empty($elementsToRemove)) {
            $elementsToRemove=$this->dataBaseColumns;
        }
        $this->unsetUnwantedKeys($elementsToRemove);
        $this->keys=array_values($this->keys);
        $this->keysLength=count($this->keys);
    }
    public function getSortedKeys()
    {
        for ($i=0; $i <$this->keysLength ; $i++) {
            for ($j=$i; $j>0  ; $j--) {
                if (is_string($this->keys[$j])) {
                    $temp = $this->keys[$j];
                    $this->keys[$j] = $this->keys[$j - 1];
                    $this->keys[$j - 1] = $temp;
                }
            }
        }
        for ($i=0; $i <$this->keysLength ; $i++) {
            for ($j=$i; $j>0  ; $j--) {
                if (is_string($this->keys[$j])) {
                    continue;
                }
                if (is_numeric($this->keys[$j])) {
                    $temp = $this->keys[$j];
                    $this->keys[$j] = $this->keys[$j - 1];
                    $this->keys[$j - 1] = $temp;
                }
            }
        }
        array_push($this->keys, 'created_at');
        return $this->keys;
    }
    private function unsetUnwantedKeys($elementsToRemove)
    {
        for ($i=0; $i <count($elementsToRemove) ; $i++) {
            if (($key = array_search($elementsToRemove[$i], $this->keys)) !== false) {
                unset($this->keys[$key]);
            }
        }
    }
}
