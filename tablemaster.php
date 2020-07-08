<?php
include("connection.php");
include("fields.php");
include("common.php");
class TableMaster extends Connection
{
    protected  $tblName;
    protected  $fields;
    protected  $fieldsName;
    protected  $fieldsType;
    protected  $Where;
    protected  $Limit;
	protected  $LikeFields;
	Protected  $LikeString;
	protected  $groupBy;
	protected  $orderByFields;
	protected  $orderByOrder;
	protected  $having;
	
    public function preparedExecuteNoneQuery($intDMLStatement)
    {
		$query = "";
		if($intDMLStatement == Common::$insert)
		{
			$query = "";
			$query = "INSERT INTO ";
			for ($i = 0; $i < count($this->tblName); $i++)
			{
				$query .= $this->tblName[$i];
				if ($i != count($this->tblName) - 1)
					$query .= ", ";
			}
	
			$query .= " ( ";
			foreach($this->fieldsName as $i=>$value)
			{
				$flag = 0;
				$query .= $this->fieldsName[$i];
				$query .= ", ";
			}
			$query = substr($query,0,strrpos($query,","));         
			$query .= " )";
			$query .= " VALUES(";

			foreach($this->fields as $i=>$value)
            {
				$flag = 0;
				if ($this->fieldsType[$i] == Fields::$number)
					$query .= $this->fields[$i];
				else if ($this->fieldsType[$i] == Fields::$date || $this->fieldsType[$i] == Fields::$text)
					$query .= "'" . $this->fields[$i] . "'";
					$query .= ", ";
			}
			$query = substr($query,0,strrpos($query,","));         
			$query .= " );";
		}
		else if($intDMLStatement == Common::$update)
		{
	        $query = "update ";
            for ($i = 0; $i < count($this->tblName); $i++)
			{
				$query .= $this->tblName[$i];
				if ($i != count($this->tblName) - 1)
					$query .= ", ";
			}
			
            $query .= " set ";

			foreach($this->fields as $key=>$value)
            {
                $flag = 0;
                $query .= $this->fieldsName[$key] . " = ";
	            if ($this->fieldsType[$key] == Fields::$number)
				{
                        $query .= $this->fields[$key];
				}
				else
				{
					$query .= "'" . $this->fields[$key] . "'";
				}
                $query .= ", ";
			}
			$query = substr($query,0,strrpos($query,","));         
            if($this->Where != NULL)
            {			
					 $query .= " WHERE " . $this->Where;				
            }
			
				
		
		}

		else if($intDMLStatement == Common::$delete)
		{
	        $query = "DELETE FROM ";
            for ($i = 0; $i < count($this->tblName); $i++)
            {
                $query .= $this->tblName[$i];
                if ($i != count($this->tblName) - 1)
                    $query .= ", ";
            }
            if($this->Where[0] != NULL || $this->Where[0] != "")
            {
                $query .= " WHERE " . $this->Where;
            }
		}
		else if($intDMLStatement == Common::$select)
		{
			$query = "SELECT * FROM ";
            for ($i = 0; $i < count($this->tblName); $i++)
            {
                $query .= $this->tblName[$i];
                if ($i != count($this->tblName) - 1)
                    $query .= ", ";
            }
			if($this->Where != NULL)
            {
                if($this->Where[0] != NULL || $this->Where[0] != "")
				{
                $query .= " WHERE " . $this->Where;
				}
			}
			
			if($this->LikeFields != NULL && $this->LikeString != NULL  )
			{
					if($this->Where != NULL)
					{
						 $query .= " AND " . $this->LikeFields . " LIKE '" . $this->LikeString ."'";
					}
					else
					{
						$query .= " WHERE " . $this->LikeFields . " LIKE '" . $this->LikeString ."'";
					}
					
			}
			if($this->orderByFields !=NULL)
			{
				$query .=" ORDER BY ".$this->orderByFields;
				if($this->orderByOrder != NULL)
				{
						$query .="  ".$this->orderByOrder;
				}
			}
            if($this->Limit != NULL)
			{
				
				$query .= " LIMIT ".$this->Limit;
			}
			    
		}

       	return $query;
    }
	
	public function aggregateExecuteNoneQuery($intAggregateFunction,$fieldName)
	{
		$query = "";
			if($intAggregateFunction == Common::$sum)
			{
				 if($this->groupBy != NULL)
				 {
					 $query = "SELECT ".$this->groupBy.",sum(".$fieldName.") FROM ";
				 }
				 else
				 {
					 $query = "SELECT sum(".$fieldName.") FROM ";
				 }
				
			}
			else if($intAggregateFunction == Common::$avg)
			{
				if($this->groupBy != NULL)
				 {
					 $query = "SELECT ".$this->groupBy.",avg(".$fieldName.") FROM ";
				 }
				 else
				 {
					 $query = "SELECT avg(".$fieldName.") FROM ";
				 }
			}	
			else if($intAggregateFunction == Common::$count)
			{
				if($this->groupBy != NULL)
				 {
					 $query = "SElECT ".$this->groupBy.",count(".$fieldName.") FROM ";
				 }
				 else
				 {
					 $query = "SELECT count(".$fieldName.") FROM ";
				 }
			}	
			else if($intAggregateFunction == Common::$min)
			{
				if($this->groupBy != NULL)
				 {
					 $query = "SELECT ".$this->groupBy.",min(".$fieldName.") FROM ";
				 }
				 else
				 {
					 $query = "SELECT min(".$fieldName.") FROM ";
				 }
			}	
			else if($intAggregateFunction == Common::$max)
			{
				if($this->groupBy != NULL)
				 {
					 $query = "SELECT ".$this->groupBy.",max(".$fieldName.") FROM ";
				 }
				 else
				 {
					 $query = "SELECT max(".$fieldName.") FROM ";
				 }
			}	
            for ($i = 0; $i < count($this->tblName); $i++)
            {
                $query .= $this->tblName[$i];
                if ($i != count($this->tblName) - 1)
                    $query .= ", ";
            }
			if($this->Where != NULL)
            {
                if($this->Where[0] != NULL || $this->Where[0] != "")
				{
                $query .= " WHERE " . $this->Where;
				}
			}
			
			if($this->LikeFields != NULL && $this->LikeString != NULL  )
			{
					if($this->Where != NULL)
					{
						 $query .= " AND " . $this->LikeFields . " LIKE '" . $this->LikeString ."'";
					}
					else
					{
						$query .= " WHERE " . $this->LikeFields . " LIKE '" . $this->LikeString ."'";
					}
					
			}   
			if($this->groupBy != NULL)
			{
					$query .=" GROUP BY ".$this->groupBy;
			}
			if($this->having != NULL)
			{
					$query .=" HAVING ".$this->having;
			}
			
			if($this->orderByFields !=NULL)
			{
				$query .=" ORDER BY ".$this->orderByFields;
				if($this->orderByOrder != NULL)
				{
						$query .="  ".$this->orderByOrder;
				}
			}

       	return $query;
	}
	
    public function setTblName($strTblName)
    {
        $this->tblName = $strTblName;
    }
    public function setWhere($strWhere)
    {
        $this->Where = $strWhere;
		
    }
	public function setLimit($intSkip,$intRows)
    {
        $this->Limit = $intSkip . ',' .$intRows;
		
    }
    //public function setFieldsName($strFieldsName)
    //{
      //  $this->fieldsName = $strFieldsName;
    //}
	public function setLike($strFieldName,$str)
	{
		$this->LikeFields = $strFieldName;
		$this->LikeString =$str;
	}
	public function setGroupBy($strFieldName)
	{
		$this->groupBy = $strFieldName;
	}
	public function setOrderBy($strFieldName)
	{
		$this->orderByFields = $strFieldName;
	}
	public function setSortMethod($str)
	{
		$this->orderByOrder =$str;
	}
	public function setHaving($fieldName,$sign,$cnt)
	{
		$this->having = $fieldName."".$sign."".$cnt;
	}
	
	
}
?>

