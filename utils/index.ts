export function createSlug(inputString: String) {
    // Remove special characters and convert to lowercase
    const slug = inputString.replace(/[^\w\s]/gi, '').toLowerCase();
    // Replace spaces with dashes
    return slug.replace(/\s+/g, '-');
}

export function addPortToURL(url: string){
    // Split the URL into parts
    const parts = url.split('://');
    
    // Insert :8000 after the domain
    parts[1] = parts[1].replace(/^([^/]+)(.*)/, '$1:8000$2');
  
    // Join the parts back together
    return parts.join('://');
  };
  
  export function generateRandomString(): string {
    const lettersAndDigits: string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let randomString: string = '';

    for (let i = 0; i < 10; i++) {
        const randomIndex: number = Math.floor(Math.random() * lettersAndDigits.length);
        randomString += lettersAndDigits.charAt(randomIndex);
    }

    return randomString.toUpperCase();
}


export function convertDate(dateString: string): string {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Split the input date string into components
    const [year, month, day] = dateString.split('-');

    // Convert the month from number to the corresponding month name
    const monthName = months[parseInt(month) - 1];

    // Return the date in the desired format
    return `${parseInt(day)} ${monthName} ${year}`;
}

export function truncateText(text: string, maxLength: number, ending: string): string {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + ending;
    }
    return text;
}

export function extractLastSegment(path: string): string {
    const segments = path.split('/');
    return segments[segments.length - 1];
}
