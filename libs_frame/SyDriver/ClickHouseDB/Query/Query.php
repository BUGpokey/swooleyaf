<?php

namespace ClickHouseDB\Query;

use ClickHouseDB\Exception\QueryException;

class Query
{
    /**
     * @var string
     */
    protected $sql;

    /**
     * @var null|string
     */
    protected $format;

    /**
     * @var array
     */
    private $degenerations = [];

    private $supportFormats = [
        'FORMAT\\s+TSVRaw',
        'FORMAT\\s+TSVWithNamesAndTypes',
        'FORMAT\\s+TSVWithNames',
        'FORMAT\\s+TSV',
        'FORMAT\\s+Vertical',
        'FORMAT\\s+JSONCompact',
        'FORMAT\\s+JSONEachRow',
        'FORMAT\\s+TSKV',
        'FORMAT\\s+TabSeparatedWithNames',
        'FORMAT\\s+TabSeparatedWithNamesAndTypes',
        'FORMAT\\s+TabSeparatedRaw',
        'FORMAT\\s+BlockTabSeparated',
        'FORMAT\\s+CSVWithNames',
        'FORMAT\\s+CSV',
        'FORMAT\\s+JSON',
        'FORMAT\\s+TabSeparated',
    ];

    /**
     * Query constructor.
     *
     * @param string $sql
     * @param array  $degenerations
     */
    public function __construct($sql, $degenerations = [])
    {
        if (!trim($sql)) {
            throw new QueryException('Empty Query');
        }
        $this->sql = $sql;
        $this->degenerations = $degenerations;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toSql();
    }

    /**
     * @param null|string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return null|string
     */
    public function getFormat()
    {
        return $this->format;
    }

    public function toSql()
    {
        if (null !== $this->format) {
            $this->applyFormatQuery();
        }

        if (count($this->degenerations)) {
            foreach ($this->degenerations as $degeneration) {
                if ($degeneration instanceof Degeneration) {
                    $this->sql = $degeneration->process($this->sql);
                }
            }
        }

        return $this->sql;
    }

    private function applyFormatQuery()
    {
        // FORMAT\s(\w)*$
        if (null === $this->format) {
            return false;
        }
        $supportFormats = implode('|', $this->supportFormats);

        $this->sql = trim($this->sql);
        if (';' == substr($this->sql, -1)) {
            $this->sql = substr($this->sql, 0, -1);
        }

        $matches = [];
        if (preg_match_all('%(' . $supportFormats . ')%ius', $this->sql, $matches)) {
            // skip add "format json"
            if (isset($matches[0])) {
                $this->format = trim(str_ireplace('format', '', $matches[0][0]));
            }
        } else {
            $this->sql = $this->sql . ' FORMAT ' . $this->format;
        }
    }
}