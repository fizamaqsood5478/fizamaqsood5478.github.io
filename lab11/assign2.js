const person = {
    // Attributes
    name: 'Fiza',
    age: 21,
    occupation: 'Software Developer',
    city: 'Karachi',
    email: 'fiza@gmail.com',

    // Methods to retrieve attribute values
    getName() {
        return this.name;
    },

    getAge() {
        return this.age;
    },

    getOccupation() {
        return this.occupation;
    },

    getCity() {
        return this.city;
    },

    getEmail() {
        return this.email;
    },

    // Methods to update attribute values
    setName(newName) {
        this.name = newName;
    },

    setAge(newAge) {
        this.age = newAge;
    },

    setOccupation(newOccupation) {
        this.occupation = newOccupation;
    },

    setCity(newCity) {
        this.city = newCity;
    },

    setEmail(newEmail) {
        this.email = newEmail;
    }
};

// Example usage:

// Retrieve attribute values
console.log(person.getName());        // Output: Fiza
console.log(person.getAge());         // Output: 25
console.log(person.getOccupation());  // Output: Software Developer
console.log(person.getCity());        // Output: Karachi
console.log(person.getEmail());       // Output: fiza@example.com

// Update attribute values
person.setName('Hira');
person.setAge(30);
person.setOccupation('Project Manager');
person.setCity('Lahore');
person.setEmail('hira@hotmail.com');

// Retrieve updated values
console.log(person.getName());        // Output: Hira
console.log(person.getAge());         // Output: 30
console.log(person.getOccupation());  // Output: Project Manager
console.log(person.getCity());        // Output: Lahore
console.log(person.getEmail());       // Output: hira@example.com
