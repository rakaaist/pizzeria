<?php

namespace Core;

/**
 * Class FileDB
 */
class FileDB
{
    private $file_name;
    private $data = [];

    /**
     * FileDB constructor.
     *
     * @param string $file_name
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Sets keys data.
     *
     * @param array $data_array
     */
    public function setData(array $data_array): void
    {
        $this->data = $data_array;
    }

    /**
     * Returns data array.
     *
     * @return mixed
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }

    /**
     * Function saves data in the file provided.
     *
     * @return bool
     */
    public function save(): bool
    {

        $bytes_written = file_put_contents($this->file_name, json_encode($this->getData()));

        if ($bytes_written === FALSE) {
            return false;
        }

        return true;
    }

    /**
     * Function loads data from the file provided
     *
     * @return bool
     */
    public function load(): bool
    {
        if (file_exists($this->file_name)) {
            $data = file_get_contents($this->file_name);

            if ($data !== false) {
                $this->setData(json_decode($data, true) ?? []);
            } else {
                $this->setData([]);
            }

            return true;
        }

        return false;
    }

    /**
     * Functions creates an empty array with table_name index if it doesn't exist yet
     *
     * @param $table_name
     * @return bool
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];

            return true;
        }

        return false;
    }

    /**
     * Functions checks whether the table_name index already exists in data array
     *
     * @param $table_name
     * @return bool
     */
    public function tableExists(string $table_name): bool
    {
        if (isset($this->getData()[$table_name])) {
            return true;
        }

        return false;
    }

    /**
     * Function deletes an array with the table_name index
     *
     * @param string $table_name
     * @return bool
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);

            return true;
        }

        return false;
    }

    /**
     * Function clears table data not the table_name index
     *
     * @param string $table_name
     * @return bool
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];

            return true;
        }

        return false;
    }

    /**
     * Function checks whether the row_id exists; if not, creates it with automatic index if not given
     *
     * @param string $table_name
     * @param array $row
     * @param null $row_id
     * @return bool|false|int|string
     */
    public function insertRow(string $table_name, array $row, $row_id = null)
    {
        if (!$this->rowExists($table_name, $row_id)) {

            if ($row_id === null) {
                $this->data[$table_name][] = $row;
                $row_id = array_key_last($this->data[$table_name]);
            } else {
                $this->data[$table_name][$row_id] = $row;
            }

            return $row_id;
        }

        return false;
    }

    /**
     * Function checks whether row_id exists
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): bool
    {
        return isset($this->getData()[$table_name][$row_id]);
    }

    /**
     * Function rewrites the row array to the new provided
     *
     * @param string $table_name
     * @param $row_id
     * @param $row
     * @return bool
     */
    public function updateRow(string $table_name, $row_id, array $row): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;

            return true;
        }

        return false;
    }

    /**
     * Function deletes the entire row if row_id exists
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     * Function returns row by row_id given if it exists
     *
     * @param string $table_name
     * @param $row_id
     * @return false|array
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * Function returns an array with rows according to conditions given
     *
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions = []): array
    {
        $results = [];

        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                $results[$row_id] = $row;
            }
        }

        return $results;
    }

    /**
     * Function returns one (first) row according to conditions given
     *
     * @param string $table_name
     * @param array $conditions
     * @return false/array
     */
    public function getRowWhere(string $table_name, array $conditions)
    {
        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                return $row;
            }
        }

        return false;
    }
}


