<?php


/**
 * Base class that represents a query for the 'event' table.
 *
 * 
 *
 * @method     EventQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     EventQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     EventQuery orderByIspublic($order = Criteria::ASC) Order by the ispublic column
 * @method     EventQuery orderByStart($order = Criteria::ASC) Order by the start column
 * @method     EventQuery orderByEnd($order = Criteria::ASC) Order by the end column
 * @method     EventQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     EventQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     EventQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     EventQuery groupByTitle() Group by the title column
 * @method     EventQuery groupByDescription() Group by the description column
 * @method     EventQuery groupByIspublic() Group by the ispublic column
 * @method     EventQuery groupByStart() Group by the start column
 * @method     EventQuery groupByEnd() Group by the end column
 * @method     EventQuery groupById() Group by the id column
 * @method     EventQuery groupByCreatedAt() Group by the created_at column
 * @method     EventQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     EventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Event findOne(PropelPDO $con = null) Return the first Event matching the query
 * @method     Event findOneOrCreate(PropelPDO $con = null) Return the first Event matching the query, or a new Event object populated from the query conditions when no match is found
 *
 * @method     Event findOneByTitle(string $title) Return the first Event filtered by the title column
 * @method     Event findOneByDescription(string $description) Return the first Event filtered by the description column
 * @method     Event findOneByIspublic(int $ispublic) Return the first Event filtered by the ispublic column
 * @method     Event findOneByStart(string $start) Return the first Event filtered by the start column
 * @method     Event findOneByEnd(string $end) Return the first Event filtered by the end column
 * @method     Event findOneById(int $id) Return the first Event filtered by the id column
 * @method     Event findOneByCreatedAt(string $created_at) Return the first Event filtered by the created_at column
 * @method     Event findOneByUpdatedAt(string $updated_at) Return the first Event filtered by the updated_at column
 *
 * @method     array findByTitle(string $title) Return Event objects filtered by the title column
 * @method     array findByDescription(string $description) Return Event objects filtered by the description column
 * @method     array findByIspublic(int $ispublic) Return Event objects filtered by the ispublic column
 * @method     array findByStart(string $start) Return Event objects filtered by the start column
 * @method     array findByEnd(string $end) Return Event objects filtered by the end column
 * @method     array findById(int $id) Return Event objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Event objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Event objects filtered by the updated_at column
 *
 * @package    propel.generator.colony.om
 */
abstract class BaseEventQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseEventQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'colony', $modelName = 'Event', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EventQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EventQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EventQuery) {
			return $criteria;
		}
		$query = new EventQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Event|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = EventPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EventPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EventPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the title column
	 * 
	 * @param     string $title The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EventPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the ispublic column
	 * 
	 * @param     int|array $ispublic The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByIspublic($ispublic = null, $comparison = null)
	{
		if (is_array($ispublic)) {
			$useMinMax = false;
			if (isset($ispublic['min'])) {
				$this->addUsingAlias(EventPeer::ISPUBLIC, $ispublic['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ispublic['max'])) {
				$this->addUsingAlias(EventPeer::ISPUBLIC, $ispublic['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::ISPUBLIC, $ispublic, $comparison);
	}

	/**
	 * Filter the query on the start column
	 * 
	 * @param     string|array $start The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByStart($start = null, $comparison = null)
	{
		if (is_array($start)) {
			$useMinMax = false;
			if (isset($start['min'])) {
				$this->addUsingAlias(EventPeer::START, $start['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($start['max'])) {
				$this->addUsingAlias(EventPeer::START, $start['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::START, $start, $comparison);
	}

	/**
	 * Filter the query on the end column
	 * 
	 * @param     string|array $end The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByEnd($end = null, $comparison = null)
	{
		if (is_array($end)) {
			$useMinMax = false;
			if (isset($end['min'])) {
				$this->addUsingAlias(EventPeer::END, $end['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($end['max'])) {
				$this->addUsingAlias(EventPeer::END, $end['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::END, $end, $comparison);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EventPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 * 
	 * @param     string|array $createdAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(EventPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(EventPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query on the updated_at column
	 * 
	 * @param     string|array $updatedAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(EventPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(EventPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EventPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Event $event Object to remove from the list of results
	 *
	 * @return    EventQuery The current query, for fluid interface
	 */
	public function prune($event = null)
	{
		if ($event) {
			$this->addUsingAlias(EventPeer::ID, $event->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(EventPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(EventPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(EventPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(EventPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(EventPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     EventQuery The current query, for fuid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(EventPeer::CREATED_AT);
	}

} // BaseEventQuery
