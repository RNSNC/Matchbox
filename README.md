### Начало работы с проектом
```
make up
make bash
make build
```
<hr>

### URL запросы
<hr>

### Производитель
#### Все производители
```
GET https://127.0.0.1:8080/api/manufacturer
```
#### Создание производителя
```
POST https://127.0.0.1:8080/api/manufacturer
```
#### Данные, требуемые для создания ( json, xml, data_form ):
```
name: test
```
<hr>

### Назначение
#### Все назначения
```
GET https://127.0.0.1:8080/api/purpose
```
#### Создание назначения
```
POST https://127.0.0.1:8080/api/purpose
```
#### Данные, требуемые для создания ( json, xml, data_form ):
```
name: test
```
<hr>

### Коробок 

#### Все коробки
```
GET https://127.0.0.1:8080/api/matchboxes
```
#### Конкретный коробок по id
```
GET https://127.0.0.1:8080/api/matchboxes/{id}
```
#### Создание коробка
```
POST https://127.0.0.1:8080/api/matchboxes
```
#### Данные, требуемые для создания ( json, xml, data_form ):
```
manufacturer: test
purpose: test
length: 2
count: 12
description: test
```
<hr>

### Консольные команды
<hr>

#### Создание коробка
```
bin/console app:matchbox:add
```
#### Просмотр коробков
```
bin/console app:matchbox:show
```
