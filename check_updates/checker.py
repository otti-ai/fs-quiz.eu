import hashlib
import requests
import os
from bs4 import BeautifulSoup

URLS = [
    {
        "url": "https://fs-quiz.eu/quizzesNew",
        "selector": "h5#demo"
    },
    {
        "url": "https://fs-alpeadria.com/fs-alpe-adria-2025/",
        "selector": "div.et_pb_text_inner"
    },
    {
        "url": "https://fsaustria.at/fsa-2025/rules-2/",
        "selector": "div.entry-content1"
    },
    {
        "url": "https://formulastudent.ch/docs.php",
        "selector": "article#main"
    },
    {
        "url": "https://www.formulastudent.de/fsg/rules/",
        "selector": "div#content"
    },
    {
        "url": "https://fseast.eu/rules-important-documents-2025/",
        "selector": "div#pl-12554"
    },
    {
        "url": "https://fsczech.cz/documents-2025/",
        "selector": "div.guten-column-wrapper"
    },
    {
        "url": "https://www.formula-student.nl/",
        "selector": "div.tco-under-construction-overlay"
    },
    {
        "url": "https://www.formulastudent.es/fss2025/",
        "selector": "div.elementor-element-c967fb0"
    },
    {
        "url": "https://www.formulastudent.pt/rules-docs-2025",
        "selector": "div#comp-m170yz738"
    },
    {
        "url": "https://fs-france.com/fsf-2025/documents/",
        "selector": "div.e-con-inner"
    },
    {
        "url": "https://fs-poland.pl/competition-25/",
        "selector": "div.elementor-element-2d918e11"
    },
    {
        "url": "https://www.formula-ata.it/handbook-2/",
        "selector": "div.so-widget-sow-editor-base"
    },
    {
        "url": "https://www.fsbalkans.ro/",
        "selector": "div#Containertuckg"
    },
    {
        "url": "https://formulastudentgreece.ihu.gr/",
        "selector": "div.wp-block-group"
    }
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
        print(f"Error {url}: {e}")
        return None

def extract_relevant_content(html, selector):
    try:
        soup = BeautifulSoup(html, "html.parser")
        selected_content = soup.select(selector)
        if selected_content:
            return "\n".join([str(element) for element in selected_content])
        else:
            print(f"Not found selector: '{selector}'")
            return ""
    except Exception as e:
        print(f"Error on selector '{selector}': {e}")
        return ""

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

    for site in urls:
        url = site["url"]
        selector = site["selector"]

        print(f"Check Site: {url} (Selektor: {selector})")

        content = fetch_website_content(url)
        if content is None:
            print(f"Error {url}, not found \n")
            continue

        relevant_content = extract_relevant_content(content, selector)
        if not relevant_content:
            print(f"Error {url}, no content\n")
            continue

        current_hash = calculate_hash(relevant_content)

        hash_file = os.path.join(HASH_FOLDER, f"{url.replace('https://', '').replace('http://', '').replace('/', '_')}.txt")

        last_hash = load_last_hash(hash_file)

        if last_hash is None:
            print(f"First run {url}.\n")
            save_current_hash(hash_file, current_hash)
        elif current_hash != last_hash:
            print(f"Update on {url} !\n")
            save_current_hash(hash_file, current_hash)
        else:
            print(f"No change {url}.\n")

if __name__ == "__main__":
    check_websites(URLS)
