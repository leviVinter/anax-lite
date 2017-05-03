#API mot MySQL-databas
Här dokumenterar jag hur man kan jobba med varukorg, order
och rapport för beställning.

##Varukorg
"CALL addToCart(customerId, productId, amount);".  
Lägg till något i varukorgen.

"SELECT * FROM VCart;".  
Visa information om varukorgen.

"CALL removeFromCart(CartRowId, amount);".  
Ett id från tabellen CartRow kan man få tag i till exempel genom
SELECT-satsen ovan.

##Order
"CALL createOrder(cartId);".  
Omvandla varukorgen till en order. Alla varor som finns i varukorgen
förflyttas från inventariet till ordern.

"SELECT * FROM VOrderDetails;".  
Se detaljer om ordern.

"CALL removeOrder(orderId);".  
Ta bort en order och lägg tillbaka produkter in i inventariet.

##Rapport
"SELECT * FROM VReOrder;".  
Se ifall nya produkter behöver beställas. Varje gång Inventory-tabellen uppdateras
slås en trigger igång för att kolla om något behöver läggas till eller kan tas bort
från tabellen ReOrderLog. Det är bara produkter som verkligen behöver beställas som
finns sparade där, så om du tar bort en order, och därmed lägger tillbaka produkter
i Inventory så märker ReOrderLog detta.

##Exempel
CALL addToCart(2, 1, 2);  
CALL addToCart(2, 4, 8);  
SELECT * FROM VCart;  
CALL removeFromCart(2, 2);  
CALL createOrder(2);  
SELECT * FROM VOrderDetails;  
SELECT * FROM VReOrder;  
CALL removeOrder(1);  
SELECT * FROM VOrderDetails;  
SELECT * FROM VReOrder;
