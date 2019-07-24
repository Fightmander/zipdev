# zipdev
rest php api

CURD endpoints

POST piltos.com/phone_book/create 
 - attributes{ id, firstName, surName, image, phones[n], emails[n] }

GET piltros.com/phone_book/read

POST piltros.com/phone_book/update
 - attributes{ id, firstName, surName  }
 
POST piltros.com/phone_book/delete
 - attributes{ id }
 
POST piltros.com/phone/create
 - attributes{ phoneBookId, phone }

GET piltros.com/phone_book/read
 - attributes{ id }
 
POST piltros.com/phone/update
 - attributes{ id, phone }
 
POST piltros.com/phone_book/delete
 - attributes{ id }
 
 POST piltros.com/email/create
  - attributes{ phoneBookId, email }
 
 GET piltros.com/email/read
  - attributes{ id }
  
 POST piltros.com/email/update
  - attributes{ id, email }
  
 POST piltros.com/email/delete
  - attributes{ id }

to watch images added visit 

piltros.com/images/{image}