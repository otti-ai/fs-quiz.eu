import hashlib
import requests
import os

URLS = [
    "https://fs-quiz.eu/quizzesNew",
    "https://fs-alpeadria.com/",
    "https://fsaustria.at/fsa-2025/rules-2/",
    "https://formulastudent.ch/docs.php",
    "https://www.formulastudent.de/fsg/rules/",
    "https://fseast.eu/rules-important-documents-2025/",
    "https://fsczech.cz/",
    "https://www.formula-student.nl/",
    "https://www.formulastudent.es/fss2025/",
    "https://www.formulastudent.pt/rules-docs-2025",
    "https://fs-france.com/fsf-2025/documents/",
    "https://fs-poland.pl/",
    "https://www.formula-ata.it/handbook-2/",
    "https://www.fsbalkans.ro/",
    "https://formulastudentgreece.ihu.gr/"
]

HASH_FOLDER = "hashes"

HEADERS = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
}

def fetch_website_content(url):
    try:
        response = requests.get(url, headers=HEADERS, timeout=10)
        response.raise_for_status()
        return response.text
    except requests.RequestException as e:
        print(f"Error on request {url}: {e}")
        return None

def calculate_hash(content):
    return hashlib.sha256(content.encode('utf-8')).hexdigest()

def load_last_hash(file_path):
    if os.path.exists(file_path):
        with open(file_path, 'r') as file:
            return file.read().strip()
    return None

def save_current_hash(file_path, hash_value):
    with open(file_path, 'w') as file:
        file.write(hash_value)

def check_websites(urls):
    if not os.path.exists(HASH_FOLDER):
        os.makedirs(HASH_FOLDER)

    for url in urls:
        print(f"Check site: {url}")

        content = fetch_website_content(url)
        if content is None:
            print(f"Error {url}, not found.\n")
            continue

        current_hash = calculate_hash(content)
        hash_file = os.path.join(HASH_FOLDER, f"{url.replace('https://', '').replace('http://', '').replace('/', '_')}.txt")
        last_hash = load_last_hash(hash_file)

        if last_hash is None:
            print(f"First call {url}\n")
            save_current_hash(hash_file, current_hash)
        elif current_hash != last_hash:
            print(f"Update on {url}\n")
            save_current_hash(hash_file, current_hash)

if __name__ == "__main__":
    check_websites(URLS)
