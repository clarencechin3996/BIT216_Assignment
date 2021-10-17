class GetVax {
    constructor(User = [], HealthCareCentre = [], Vaccine = []) {
        this.User = User;
        this.HealthCareCentre = HealthCareCentre;
        this.Vaccine = Vaccine;
    }

    userAdd(user) {
        this.User.push(user);
    }

    healthCareCentreAdd(hcc) {
        this.HealthCareCentre.push(hcc);
    }

    vaccineAdd(vaccine) {
        this.Vaccine.push(vaccine);
    }

    getHealthCareCentre() {
        return this.HealthCareCentre;
    }

    getVaccine() {
        return this.Vaccine;
    }

}

class User {
    constructor(username, password, email, fullName) {
        this.username = username;
        this.password = password;
        this.email = email;
        this.fullName = fullName;
    }
}

class Patient extends User {
    constructor(username, password, email, fullName, ICPassport, Vaccination = []) {
        super(username, password, email, fullName);
        this.ICPassport = ICPassport;
        this.Vaccination = Vaccination;
    }

    vaccinationAdd(vaccination) {
        this.Vaccination.push(vaccination);
    }
}

class Administer extends User {
    constructor(username, password, email, fullName, staffID) {
        super(username, password, email, fullName);
        this.staffID = staffID;
    }
}

class HealthCareCentre {
    constructor(centreName, address, Batch = [], Administer = []) {
        this.centreName = centreName;
        this.address = address;
        this.Batch = Batch;
        this.Administer = Administer;
    }
    healthcare_batchAdd(batch) {
        this.Batch.push(batch);
    }

    healthcare_administerAdd(administer) {
        this.Administer.push(administer);
    }

    setCentreName(centreName) {
        this.centreName = centreName;
    }

    getCentreName() {
        return this.centreName;
    }

    getHealthCareCentreBatch() {
        return this.Batch;
    }

    getAdminister() {
        return this.Administer;
    }
}

class Vaccine {
    constructor(vaccineID, manufacturer, vaccineName, Batch = []) {
        this.vaccineID = vaccineID;
        this.manufacturer = manufacturer;
        this.vaccineName = vaccineName;
        this.Batch = Batch;
    }

    setID(vaccineID) {
        this.vaccineID = vaccineID;
    }

    getID() {
        return this.vaccineID;
    }
    getVaccineName() {
        return this.vaccineName;
    }

    vaccine_batchAdd(batch) {
        this.Batch.push(batch);
    }

    getBatch() {
        return this.Batch;
    }


}

class Batch {
    constructor(batchNo, expiryDate, numberOfAppointment, quantityAvailable, quantityAdministered, Vaccination = []) {
        this.batchNo = batchNo;
        this.expiryDate = expiryDate;
        this.numberOfAppointment = numberOfAppointment;
        this.quantityAvailable = quantityAvailable;
        this.quantityAdministered = quantityAdministered;
        this.Vaccination = Vaccination;
    }
    batch_vaccinationAdd(vaccination) {
        this.Vaccination.push(vaccination);
    }

    getBatchNo() {
        return this.batchNo;
    }

    getExpiryDate() {
        return this.expiryDate;
    }

    setNumberOfAppointment(numberOfAppointment) {
        this.numberOfAppointment = numberOfAppointment;
    }

    getNumberOfAppointment() {
        return this.numberOfAppointment;
    }

    setQuantityAvailable(quantityAvailable) {
        this.quantityAvailable = quantityAvailable;
    }

    getQuantityAvailable() {
        return this.quantityAvailable;
    }

    setQuantityAdministered(quantityAdministered) {
        this.quantityAdministered = quantityAdministered;
    }

    getQuantityAdministered() {
        return this.quantityAdministered;
    }

    getVaccination() {
        return this.Vaccination;
    }


}

class Vaccination {
    constructor(vaccinationID, appointmentDate, status, remark) {
        this.vaccinationID = vaccinationID;
        this.appointmentDate = appointmentDate;
        this.status = status;
        this.remark = remark;
    }
    setVaccinationID(vaccinationID) {
        this.vaccinationID = vaccinationID;
    }

    getVaccinationID() {
        return this.vaccinationID;
    }

    getAppointmentDate() {
        return this.appointmentDate;
    }

    setStatus(status) {
        this.status = status;
    }

    getStatus() {
        return this.status;
    }

    setRemark(remark) {
        this.remark = remark;
    }

    getRemark() {
        return this.remark;
    }
}


var getvax = new GetVax([], [], []);

var userOne = new Patient('Adam', '123', 'xxx@gmail.com', 'adam smith', 12 - 223123 - 23, []);
var userTwo = new Administer('Ali', '123', 'yyy@gmail.com', 'Ali smith', 'S1001');

var vaccine1 = new Vaccine('V001', 'HELP Sdn. Bhd', 'Phizer', []);
var vaccine2 = new Vaccine('V002', 'Noo Sdn. Bhd', 'Astra Zeneca', []);
var vaccine3 = new Vaccine('V003', 'Astra Kinetic', 'Covac', []);


var healthcarecentre1 = new HealthCareCentre('Pantai Hospital', 'taman cheras 1', [], []);

var vaccination1 = new Vaccination('V1001', '2021-02-09', 'PENDING', '-');
var vaccination2 = new Vaccination('V1002', '2021-03-19', 'PENDING', '-');
var vaccination3 = new Vaccination('V1003', '2021-01-29', 'ADMINISTERED', '-');

var batch1 = new Batch('B1001', '2021-03-19', 1, 12, 0, []);
var batch2 = new Batch('B1002', '2021-04-02', 1, 11, 0, []);
var batch3 = new Batch('B1003', '2021-09-12', 3, 1, 1, []);



getvax.userAdd(userOne); // GetVax add Patient User
getvax.userAdd(userTwo); // GetVax add Administrator User

getvax.vaccineAdd(vaccine1); //GetVax add Vaccine
getvax.vaccineAdd(vaccine2);
getvax.vaccineAdd(vaccine3);

getvax.healthCareCentreAdd(healthcarecentre1); // GetVax add HealthCareCentre


healthcarecentre1.healthcare_batchAdd(batch1); //HealthCareCentre add Batch
healthcarecentre1.healthcare_batchAdd(batch2);
healthcarecentre1.healthcare_batchAdd(batch3);
healthcarecentre1.healthcare_administerAdd(userTwo);//HealthCareCentre add Admin User

vaccine1.vaccine_batchAdd(batch1); //Vaccine add Batch
vaccine1.vaccine_batchAdd(batch2);

vaccine2.vaccine_batchAdd(batch2);
vaccine2.vaccine_batchAdd(batch3);

vaccine3.vaccine_batchAdd(batch1);
vaccine3.vaccine_batchAdd(batch2);
vaccine3.vaccine_batchAdd(batch3);


batch1.batch_vaccinationAdd(vaccination1); //Batch add vaccination
batch2.batch_vaccinationAdd(vaccination2);
batch3.batch_vaccinationAdd(vaccination1);
batch3.batch_vaccinationAdd(vaccination2);
batch3.batch_vaccinationAdd(vaccination3);

userOne.vaccinationAdd(vaccination1); // Patient user 1 add Vaccination



function healthcareBatch() {
    for (var i = 0; i < getvax.getHealthCareCentre().length; i++) {
        //condition for finding admin work for healthcare centre 
        return getvax.getHealthCareCentre()[0].getHealthCareCentreBatch();
    }
}

function findBatch(find) {
    for (var i = 0; i < getvax.getHealthCareCentre()[0].getHealthCareCentreBatch().length; i++) {
        if (getvax.getHealthCareCentre()[0].getHealthCareCentreBatch()[i].getBatchNo() === find) {
            return getvax.getHealthCareCentre()[0].getHealthCareCentreBatch()[i].getVaccination();
        }
    }
}





