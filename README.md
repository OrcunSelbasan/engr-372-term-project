Project Details

The goal is to provide a easy to use user interface to manage entities that are involved in the waste disposal processes. These entities can be categorized in four sections:

Storage/Inventory: We need to manage bins and garbage collection trucks, because both has a capability to carry the waste whether it is moving or not. 

Employees: We need to manage the employees because we want be able to decide who will be responsible for the tasks related to the waste disposal process.

Regions: We want to manage the regions because we want to be able to organize how the tasks are distributed to the current employees considering the current storage capacity.

Cities: We want to manage the cities because we want to distribute the resources efficiently between cities, therefore regions.

Let's look at an example use case:
1. Administrator is logged in to the system and wants to record storage objects
2. Admin opens the storage management panel and shows the current status of the storage. As it is the first time, no data is shown but website suggests user to create a storage object.
3. User creates a storage object and specifies its capacity, location, waste type, bin type(smart bin/ordinary bin) id(if has a barcode on it), initial worth, employee assigned to it, etc.
4. User also creates another storage related object, garbage collection truck which has capacity, a route to follow, employees assigned to it, average fuel usage, availability(needs repair or maintenance), etc.
5. As there are no employees are registered into the system user needs to create employees. Enters personal information, work description, employee role, etc.
6. After some time user created lots of storage objects and employees and it gets harder to check which truck is available or which bin needs to be emptied. Therefore decides to create different regions.
7. User creates a region(district) to assign storage objects and employees to this region. Also specifies the locations, waste collection intervals, assigned teams, required threshold for collection, etc.
8. After some time, regions grow, workforce and storage objects increase. Therefore admin needs to manage all of the resources between cities. So adds a city to the system. This allows storage objects and employees to be transferred between cities, allows adjusting the resource capacity of a city, or allows adjusting the budget of a city.
9. Finally, system is working and user wants to create report about X,Y district. User choose X,Y districts. Creates additional filters if possible and creates a report. This report includes every information about X,Y districts. User could also retrieve information about A,B,C storage objects and create a report from it.
10. To make all the data up-to-date, every employee in the field fills a form whether the truck is available or not. If the waste in the bin is collected or not.


This is the overall idea of the project, basically each entity has a relationship between them but they may exist without each other. Independent existence may cause the entities no to be a functional one.

The custom features can be added to the modules. Let's say storage module's developer wants to implement a smart bin feature to update the data without form submissions. However those features should be implemented after the core functionality of the module is implemented.

The core functionalities of any module are creating an entity, removing an entity, updating an entity without removing the other previous information, and finally displaying the data.
