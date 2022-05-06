<?php
/**
 * 多表查询sql语句
 */

//"库存量-bookSum","可借数量-rest","借阅次数-degree"
$sql1 = "select canBorrow.*,borrowNum.degree from (select tb_bookborrow.bookId,tb_stock.bookSum,tb_stock.bookSum-count(tb_bookborrow.bookId) as rest
FROM tb_bookborrow left join tb_stock on tb_bookborrow.bookId = tb_stock.bookId 
GROUP BY bookId) as canBorrow left join (select bookId,count(bookId) as degree from tb_bookBorrow
GROUP BY bookId ) as borrowNum on canBorrow.bookId = borrowNum.bookId";
//"图书名-bookName","图书类型-typeName","书架名称-caseName","出版社-pressName","作者-bookAuthor","价格-bookPrice"
$sql2 = "select book.*,type.typeName as typeName ,
bookcase.caseName as caseName,press.pressName as pressName 
from tb_book as book left join tb_booktype as type
on book.bookTypeId=type.id
join tb_case as bookcase on bookcase.id=book.bookcaseId
join tb_press as press on press.id=book.bookPressId";

//图书名-bookName 图书类型-typeName 书架名-caseName
$sql3 = "select book.*,type.typeName as typeName ,
bookcase.caseName as caseName 
from tb_book as book left join tb_booktype as type
on book.bookTypeId=type.id
join tb_case as bookcase on bookcase.id=book.bookcaseId ";
//借阅者-name 借阅日期-borrowData
$sql4 = "select borrow.*, user.name as name from tb_bookborrow as borrow left join 
tb_user as user on borrow.readerId = user.id ";
