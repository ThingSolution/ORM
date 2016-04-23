# ThingORM
This is small library to build your query and map result to your Entity object in automatic way.

## 1. Build Query.
###1.1 Build Select query
```
$query = MySqlQuery::select(['id','name','address'])
    ->from("user")
    ->rightJoin('user_info','user.id','=','user_info.user_id')
    ->where('id','>','3')
    ->whereIn('id',['2','3'])
    ->whereNotIn('id',['3','4'])
    ->whereNull('address')
    ->whereNotNull('name')
    ->whereBetween('name','4444','5555')
    ->whereNotBetween('name','6666','7777')
    ->groupBy('id')
    ->groupBy('name')
    ->having('id','>',30)
    ->having('id','>',30)
    ->orderBy('id','desc')
    ->limit(10)
    ->offset(20);
```
###1.2 Build Update query
```
$query = MySqlQuery::update()->table("user")
    ->set(['id'=>'1','name'=>'22323'])
    ->innerJoin('user_info','user.id','=','user_info.user_id')
    ->where('name','=','sdsdsd')
    ->where('id','=','2222')
    ->orderBy('name','desc')
    ->limit(10);
```
###1.3 Build Delete query
```
$query = MySqlQuery::update()->delete()
    ->from('user')
    ->innerJoin('user_info','user_id','=','id')
    ->where('id','=','ssd')
    ->where('name','=','sdsds');
```
###1.4 Build Insert query
```
$query = MySqlQuery::insert()->into('user')
    ->values(['id'=>'sdsds','name'=>'sdsdsd','created_at'=>array('now()')])
    ->generateSQL();
```

###1.5 Build Batch Insert query
```
$query = MySqlQuery::batchInsert()->into('user')
    ->values([
        ['name'=>'sdsds','address'=>'wewew','created_at'=>array('now()')],
        ['name'=>'asasa','address'=>'dfdfdf','created_at'=>array('now()')],
        ['name'=>'gggdg','address'=>'sddfsf','created_at'=>array('now()')]
        ])
```
##2. How to use some mysql function within query with ThingORM
For example, you want to use function ```now()``` in insert query, just use this function by ```array(now())``` like this:
```
$query = MySqlQuery::insert()->into('user')
    ->values(['id'=>'sdsds','name'=>'sdsdsd','created_at'=>array('now()')])
    ->generateSQL();
```
