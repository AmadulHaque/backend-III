1. Authentication and User Management

    User: Represents a user in the system.
    AuthController: Handles login/logout operations.
    AuthRequest: DTO for authentication requests.
    AuthService: Manages authentication .
    AuthMiddleware: Middleware to protect endpoints.

2. File Handling

    CSVUploadController: Handles file uploads.
    CSVUploadRequest: DTO for file upload requests.
    CSVService: Processes CSV files and extracts keywords.

3. Search Operations

    SearchController: API endpoints for triggering searches.
    SearchRequest: DTO for search requests.
    SearchService: Manages Google search operations and processes results.
    GoogleSearchClient: Makes network calls to Google and fetches results.

4. Database Models and Persistence

    SearchResult: Represents search results stored in the database.
    SearchHistory: Tracks user searches.
    DatabaseClient: Handles database interactions (CRUD operations).

5. Utilities and Helpers

    NetworkService: Makes HTTP requests to Google.
    FileStorageService: Handles temporary storage of uploaded CSV files.
    ErrorHandler: Manages application-wide error handling and logging.